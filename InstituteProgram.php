<?php

namespace App\Controllers;

use App\Models\InstituteProgramModel;
use App\Models\InstituteModel;
use App\Models\ProgramModel;

class InstituteProgram extends BaseController
{
    // Method to display the mapping form
    public function addMappingForm()
    {
        // Load models
        $instituteModel = new InstituteModel();
        $programModel = new ProgramModel();

        // Get all institutes and programs
        $data['institutes'] = $instituteModel->findAll();
        $data['programs'] = $programModel->findAll();

        return view('add_institute_program', $data);
    }

    // Method to process the adding of a new mapping
    public function addMapping()
    {
        // Get form input
        $data = [
            'institute_id' => $this->request->getPost('institute_id'),
            'program_id' => $this->request->getPost('program_id'),
            'seats' => $this->request->getPost('seats'),
        ];

        $model = new InstituteProgramModel();

        if ($model->insert($data)) {
            return redirect()->to('institute-program/add')->with('success', 'Mapping added successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to add the mapping.');
        }
    }

    // Method to manage all institute-program mappings
    public function manageMappings()
{
    $model = new InstituteProgramModel();

    // Join with `institutes` and `programs` tables to get the names
    $data['mappings'] = $model->select('institute_programs.*, institutes.institute_name, programs.program_name')
        ->join('institutes', 'institutes.institute_id = institute_programs.institute_id')
        ->join('programs', 'programs.program_id = institute_programs.program_id')
        ->findAll();
    
    return view('manage_institute_programs', $data);
}

    // Method to edit an institute-program mapping
    public function editMapping($id)
    {
        $model = new InstituteProgramModel();
        $mapping = $model->find($id);

        if (!$mapping) {
            return redirect()->to('/institute-program/manage')->with('error', 'Mapping not found.');
        }

        // Load models for institutes and programs
        $instituteModel = new InstituteModel();
        $programModel = new ProgramModel();

        $data['institutes'] = $instituteModel->findAll();
        $data['programs'] = $programModel->findAll();
        $data['mapping'] = $mapping;

        return view('edit_institute_program', $data);
    }

    // Method to process updating the mapping
    public function updateMapping($id)
    {
        $model = new InstituteProgramModel();

        // Collect updated data
        $data = [
            'institute_id' => $this->request->getPost('institute_id'),
            'program_id' => $this->request->getPost('program_id'),
            'seats' => $this->request->getPost('seats'),
        ];

        // Attempt to update the mapping
        if ($model->update($id, $data)) {
            return redirect()->to('/institute-program/manage')->with('success', 'Mapping updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update the mapping.');
        }
    }

    // Method to delete a mapping
    public function deleteMapping($id)
    {
        $model = new InstituteProgramModel();

        if ($model->delete($id)) {
            return redirect()->to('/institute-program/manage')->with('success', 'Mapping deleted successfully.');
        } else {
            return redirect()->to('/institute-program/manage')->with('error', 'Failed to delete the mapping.');
        }
    }
}
