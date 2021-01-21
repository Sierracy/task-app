<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-l text-gray-800 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                        <form action="{{ route('updateTask') }}" method="post">
                            @csrf 
                            
                            <input type="hidden" name="id" value="{{$task->id}}">
                            <input type="hidden" name="user_id" value="{{$task->user_id}}">

                            <!-- Task Name field -->              
                            <div class="mb-4">
                                <label for="description" class="sr-only">Description</label>
                                <textarea name="description" id="description" cols="30" rows="1" class="bg-gray-100 hover:bg-blue-100 border-2 w-full p-4 rounded-lg" placeholder="Description">{{$task->description}}</textarea>
                            </div>

                            <!-- Assigned To field. TODO upgrade to dropdown of users -->
                            <div class="mb-4">
                                <label for="assigned_to" class="sr-only">Assigned To</label>
                                <textarea name="assigned_to" disabled id="assigned_to" cols="30" rows="1" class="w-full p-4 border-none" placeholder="Who is responsible?">Assigned: {{$task->assigned_to}}</textarea>
                            </div>
                            
                            <div class="inline-block mb-4">
                                <!-- Priority Dropdown -->
                                <label for="priority" class="sr-only"></label>
                                <select class="rounded" name='priority'>
                                    <option selected disabled>Current Priority: {{$task->priority}}</option>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                    <option value="Critical">Critical</option>
                                
                                </select>

                                <!--Status Dropdown-->
                                <label for="status" class="sr-only"></label>
                                <select class="rounded" name='status'>
                                    <option selected disabled>Current Status: {{$task->status}}</option>
                                    <option value="Pending">Pending</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Complete">Complete</option>
                                </select>
                            
                                <!-- Due Date Picker -->
                                <label for="due_date" class="sr-only"></label>

                                <!-- needs update/validation for Safari and IE browsers -->
                                <input class="rounded" type="date" name="due_date" value="{{$task->due_date}}" placeholder="yyyy-mm-dd">
                            </div>

                            <div>
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Save</button>                            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>