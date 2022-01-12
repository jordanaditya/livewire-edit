<div>
    <!-- Card -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @if (session()->has('message'))
                        <div class="alert alert-success text-center">{{ session('message') }}</div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->phone }}</td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-sm btn-primary"
                                            wire:click="editStudents({{ $student->id }})">Edit</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="editStudentModal" tabindex="-1" data-backdrop="static"
        data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        wire:click="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form wire:submit.prevent="editStudentData">
                        {{-- <div class="form-group row">
                            <label for="student_id" class="col-3">Student ID</label>
                            <div class="col-9">
                                <input type="number" id="student_id" class="form-control" wire:model="student_id">
                                @error('student_id')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}
                        <input type="hidden" wire:model="student_id">
                        <div class="form-group row">
                            <label for="name" class="col-3">Name</label>
                            <div class="col-9">
                                <input type="text" id="name" class="form-control" wire:model="name">
                                @error('name')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-3">Email</label>
                            <div class="col-9">
                                <input type="email" id="email" class="form-control" wire:model="email">
                                @error('email')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-3">Phone</label>
                            <div class="col-9">
                                <input type="number" id="phone" class="form-control" wire:model="phone">
                                @error('phone')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-3"></label>
                            <div class="col-9">
                                <button type="submit" class="btn btn-sm btn-primary">Edit Student</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('close-modal', event => {
            $('#editStudentModal').modal('hide');
        });

        window.addEventListener('show-edit-student-modal', event => {
            $('#editStudentModal').modal('show');
        });
    </script>
@endpush
