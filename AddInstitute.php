<?php

namespace App\Controllers;
use App\Models\InstituteModel;

class AddInstitute extends BaseController
{
    // Display the Add Institute form
    public function index()
    {
        return view('add_institute');
    }

    // Display all institutes in the manage institutes view
    public function manageInstitutes()
    {
        $instituteModel = new InstituteModel();
        $data['institutes'] = $instituteModel->findAll(); // Retrieve all institutes

        return view('manage_institute', $data); // Load the manage institutes view
    }

    // Add a new institute
    public function addInstitute()
    {
        // Load the model
        $instituteModel = new InstituteModel();

        // Get form input
        $data = [
            'institute_name' => $this->request->getPost('institute_name'),
            'location' => $this->request->getPost('location'),
        ];

        // Save to the database
        if ($instituteModel->insert($data)) {
            return redirect()->back()->with('success', 'Institute added successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to add the institute.');
        }
    }

    // Edit an existing institute form
    public function editInstituteForm($id)
    {
        $instituteModel = new InstituteModel();
        $institute = $instituteModel->find($id);

        if (!$institute) {
            return redirect()->to('/manage-institutes')->with('error', 'Institute not found.');
        }

        return view('edit_institute', ['institute' => $institute]);
    }

    // Process edit institute data
    public function processEditInstitute($id)
    {
        $instituteModel = new InstituteModel();
        $institute = $instituteModel->find($id);

        if (!$institute) {
            return redirect()->to('/manage-institutes')->with('error', 'Institute not found.');
        }

        $instituteData = [
            'institute_name' => $this->request->getPost('institute_name'),
            'location' => $this->request->getPost('location'),
        ];

        try {
            if ($instituteModel->update($id, $instituteData)) {
                return redirect()->to('/manage-institutes')->with('success', 'Institute updated successfully.');
            } else {
                return redirect()->back()->with('error', 'No changes were made to the institute.');
            }
        } catch (\Exception $e) {
            log_message('error', 'Error updating institute: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating the institute.');
        }
    }

    // Delete an institute
    public function deleteInstitute($id)
    {
        $instituteModel = new InstituteModel();

        if ($instituteModel->delete($id)) {
            return redirect()->to('/manage-institutes')->with('success', 'Institute deleted successfully.');
        } else {
            return redirect()->to('/manage-institutes')->with('error', 'Failed to delete the institute.');
        }
    }
}
