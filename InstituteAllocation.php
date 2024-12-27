<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\StudentDetailsModel;
use App\Models\InstituteProgramModel;
use CodeIgniter\Controller;

class InstituteAllocation extends Controller
{
    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->studentDetailsModel = new StudentDetailsModel();
        $this->instituteProgramModel = new InstituteProgramModel();
        $this->db = \Config\Database::connect();
    }

    // Show student applications with filtering options
    public function showStudentApplications()
    {
        helper('form');
        // Load all programs for the program filter dropdown
        $data['programs'] = $this->db->table('programs')->select('program_id, program_name')->get()->getResultArray();

        // Initialize student and institute data
        $data['students'] = [];
        $data['institutes'] = [];

        // If program filter is applied
        $program_id = $this->request->getPost('program_id');
        if ($program_id) {
            // Fetch the program name based on the selected program_id
            $program = $this->db->table('programs')
                ->select('program_name')
                ->where('program_id', $program_id)
                ->get()
                ->getRowArray();

            // Fetch students who have shown interest in the selected program by program name
            $data['students'] = $this->db->table('studentDetails')
                ->join('students', 'studentDetails.uid = students.uid')
                ->select('students.id, students.student_name, students.program_interested, students.entrance_score, studentDetails.uid,studentDetails.id AS student_details_id')
                ->where('students.program_interested', $program['program_name'])
                ->whereNotIn('studentDetails.id', function ($builder) {
                    $builder->select('student_id')
                        ->from('student_institute_allocations')
                        ->whereIn('allocation_status', ['allocated', 'accepted', 'rejected', 'document_verified', 'fees_paid']);
                    })
                ->get()
                ->getResultArray();

            // Fetch institutes related to the selected program
            $data['institutes'] = $this->instituteProgramModel
                ->select('institute_programs.institute_id, institutes.institute_name, institute_programs.seats_remaining')
                ->join('institutes', 'institute_programs.institute_id = institutes.institute_id')
                ->where('institute_programs.program_id', $program_id)
                ->where('institute_programs.seats_remaining >', 0)
                ->get()
                ->getResultArray();
        }

        return view('institute_allocation', $data);
    }

    // Handle the allocation of a student to an institute
    public function allocateInstitute()
    {
        $student_id = $this->request->getPost('student_id');
        $institute_id = $this->request->getPost('institute_id');

        // Begin transaction for atomic update
        $this->db->transStart();

        // Insert allocation entry
        $this->db->table('student_institute_allocations')->insert([
            'student_id' => $student_id,
            'institute_id' => $institute_id,
            'allocation_status' => 'allocated',
            'allocated_on' => date('Y-m-d H:i:s')
        ]);

        // Decrease seat count for the selected institute and program
        $this->instituteProgramModel
            ->set('seats_remaining', 'seats_remaining - 1', false)
            ->where('institute_id', $institute_id)
            ->update();

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return redirect()->back()->with('error', 'Allocation failed.');
        }

        return redirect()->to('showStudentApplications')->with('success', 'Student successfully allocated to the institute.');

    }
}
