<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form action="{{ route('dashboard') }}" method="post">
                            @csrf 

                            <!-- Task Name field -->
                            <div class="mb-4">
                                <label for="description" class="sr-only">Description</label>
                                <textarea name="description" id="description" cols="30" rows="1" class="bg-gray-100 border-2 w-full p-4 rounded-lg" placeholder="Create a task!"></textarea>
                            </div>

                            <!-- Assigned To field. TODO upgrade to dropdown of users -->
                            <div class="mb-4">
                                <label for="assigned_to" class="sr-only">Assigned To</label>
                                <textarea name="assigned_to" id="assigned_to" cols="30" rows="1" class="bg-gray-100 border-2 w-full p-4 rounded-lg" placeholder="Who is responsible?"></textarea>
                            </div>

                            <!-- Status Drop Down -->
                            <div class="inline-block mb-4">
                                <label for="status" class="sr-only"></label>
                                <select class="rounded" name='status'>
                                    <option selected disabled>Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Complete">Complete</option>
                                </select>
                            

                            <!-- Priority Dropdown -->
                            
                                <label for="priority" class="sr-only"></label>
                                <select class="rounded" name='priority'>
                                    <option selected disabled>Priority</option>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                    <option value="Critical">Critical</option>
                                
                                </select>
                            

                            <!-- Due Date Picker -->
                            
                                <label for="due_date" class="sr-only"></label>

                                <!-- needs update/validation for Safari and IE browsers -->
                                <input class="rounded" type="date" name="due_date" placeholder="yyyy-mm-dd">
                            </div>

                            <div>
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>                            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
