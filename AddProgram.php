<?php

namespace App\Controllers;
use App\Models\ProgramModel;

class AddProgram extends BaseController
{
    public function index(): string
    {
        return view('addprogram');

    }
    public function managePrograms()
    {
        $programModel = new ProgramModel();
        $data['programs'] = $programModel->findAll(); // Retrieve all programs

        return view('manage_program', $data); // Load the manage programs view
    }
    public function addProgram()
    {

        // Load the model
        $programModel = new ProgramModel();

        // Get form input
        $data = [
            'program_name' => $this->request->getPost('program_name'),
            'brochure_fees' => $this->request->getPost('brochure_fees'),
            'fees' => $this->request->getPost('fees'),
            // Add 'total_seats' if included in your form
        ];

        // Save to the database
        if ($programModel->insert($data)) {
            return redirect()->back()->with('success', 'Program added successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to add the program.');
        }
    }
    
    public function editProgramForm($id)
{
    $programModel = new ProgramModel();
    $program = $programModel->find($id);

    if (!$program) {
        return redirect()->to('/manage-program')->with('error', 'Program not found.');
    }

    return view('edit_program', ['program' => $program]);
}
public function processEditProgram($id)
{
    $programModel = new ProgramModel();
    $program = $programModel->find($id);

    if (!$program) {
        // If the program is not found, redirect to the manage-program page with an error
        return redirect()->to('/manage-program')->with('error', 'Program not found.');
    }

    // Collect and validate input data from the form
    $programData = [
        'program_name' => $this->request->getPost('program_name'),
        'brochure_fees' => $this->request->getPost('brochure_fees'),
        'fees' => $this->request->getPost('fees'),
    ];

    // Debugging log to ensure data is being received as expected
    log_message('debug', 'Received data for update: ' . print_r($programData, true));

    // Attempt to update the program record
    try {
        if ($programModel->update($id, $programData)) {
            // Redirect back to the manage-program page with a success message
            return redirect()->to('/manage-program')->with('success', 'Program updated successfully.');
        } else {
            // If no changes were made, inform the user
            return redirect()->back()->with('error', 'No changes were made to the program.');
        }
    } catch (\Exception $e) {
        // Log the error and inform the user if there's a database or system error
        log_message('error', 'Error updating program: ' . $e->getMessage());
        return redirect()->back()->with('error', 'An error occurred while updating the program.');
    }
}

public function deleteProgram($id)
{
    $programModel = new ProgramModel();

    if ($programModel->delete($id)) {
        return redirect()->to('/manage-programs')->with('success', 'Program deleted successfully.');
    } else {
        return redirect()->to('/manage-programs')->with('error', 'Failed to delete the program.');
    }
}
}
