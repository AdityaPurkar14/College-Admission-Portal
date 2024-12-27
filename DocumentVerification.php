<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\InstituteProgramModel;
use App\Models\StudentModel;
use App\Models\StudentDetailsModel;
use App\Models\StudentInstituteAllocationModel;

class DocumentVerification extends Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->studentInstituteAllocationsModel = new StudentInstituteAllocationModel();
        $this->studentModel = new StudentModel();
        $this->studentDetailsModel = new StudentDetailsModel();
    }

    // Show students filtered by program and their current status
    public function index()
    {
        helper('form');
        // Get all programs for the dropdown
        $data['programs'] = $this->db->table('programs')->select('program_id, program_name')->get()->getResultArray();
        $data['students'] = [];
        
        // If program is selected, filter students based on that program
        $program_id = $this->request->getPost('program_id');
        if ($program_id) {
            // Fetch program name
            $program = $this->db->table('programs')
                ->select('program_name')
                ->where('program_id', $program_id)
                ->get()
                ->getRowArray();

            // Fetch students who have been allocated an institute for the selected program
            $data['students'] = $this->db->table('student_institute_allocations')
                ->join('studentdetails', 'student_institute_allocations.student_id = studentdetails.id')
                ->join('students', 'students.uid = studentdetails.uid')
                ->select('student_institute_allocations.id, student_institute_allocations.allocation_status, student_institute_allocations.note, students.student_name, students.program_interested, studentdetails.uid')
                ->where('students.program_interested', $program['program_name'])
                ->whereIn('student_institute_allocations.allocation_status', ['accepted']) // Only show students that have been allocated or accepted
                ->get()
                ->getResultArray();
        }

        return view('document_verification', $data);
    }

    // Update the document verification status and notes for a student
    public function updateStatus()
    {
        $allocation_id = $this->request->getPost('allocation_id');
        $status = $this->request->getPost('status');
        $note = $this->request->getPost('note');

        // Update the student allocation status and note
        $this->studentInstituteAllocationsModel->update($allocation_id, [
            'allocation_status' => $status,
            'note' => $note
        ]);

        $studentInstitute = $this->studentInstituteAllocationsModel->where('id',$allocation_id)->first();
        $studentDetails = $this->studentDetailsModel->where('id',$studentInstitute['student_id'])->first();
        $student = $this->studentModel->where('uid',$studentDetails['uid'])->first();


        $updated = $this->studentModel->where('uid', $student['uid'])
            ->set(['stage' => 6])
            ->update();
        return redirect()->to('/document-verification')->with('success', 'Document verification status updated successfully.');
    }
}
