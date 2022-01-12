<?php

namespace App\Http\Livewire;

use App\Models\Students;
use Livewire\Component;
use phpDocumentor\Reflection\Types\This;

class StudentsComponent extends Component
{
    public $student_id, $name, $email, $phone, $student_edit_id, $student_delete_id;

    public $view_student_id, $view_student_name, $view_student_email, $view_student_phone;

    //Input fields on update validation
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'student_id' => 'required|unique:students,student_id,'.$this->student_edit_id.'', //Validation with ignoring own data
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);
    }

    public function resetInputs()
    {
        $this->student_id = '';
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->student_edit_id = '';
    }

    public function close()
    {
        $this->resetInputs();
    }

    public function editStudents($id)
    {
        $student = Students::where('id', $id)->first();

        $this->student_edit_id = $student->id;
        $this->student_id = $student->student_id;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->phone = $student->phone;

        $this->dispatchBrowserEvent('show-edit-student-modal');
    }
    
    public function editStudentData()
    {
        //on form submit validation
        $this->validate([
            'student_id' => 'required|unique:students,student_id,'.$this->student_edit_id.'', //Validation with ignoring own data
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);

        $student = Students::where('id', $this->student_edit_id)->first();
        $student->student_id = $this->student_id;
        $student->name = $this->name;
        $student->email = $this->email;
        $student->phone = $this->phone;

        $student->save();

        session()->flash('message', 'Student has been updated successfully');

        //For hide modal after add student success
        $this->dispatchBrowserEvent('close-modal');
    }


    public function cancel()
    {
        $this->student_delete_id = '';
    }


    public function render()
    {
        //Get all students
        $students = Students::all();

        return view('livewire.students-component', ['students'=>$students])->layout('livewire.layouts.base');
    }
}