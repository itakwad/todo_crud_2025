<div>
    <!-- شريط البحث -->
    <div class="mb-4 relative">
        <input type="text" wire:model.live.debounce.500ms='search'
            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="بحث...">
        <div class="absolute left-3 top-2.5 text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd" />
            </svg>
        </div>
    </div>

    <!-- قائمة المهام -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        {{ $todos->links() }}
        @foreach ($todos as $todo)
        <div class="p-4 border-b border-gray-200">
            <div class="flex items-center">
                <input
                wire:click='toggle({{ $todo->id }})'
                type="checkbox" class="h-5 w-5 text-blue-500 rounded focus:ring-blue-400"
                @if ($todo->completed)
                    checked
                @endif
                >
                <div class="mr-3 flex-1">
                    @if($editing == $todo->id)
                        <div class="space-y-2">
                            <input wire:model="editTitle" class="w-full px-2 py-1 border rounded">
                            @error('editTitle')
                            <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span>
                            @enderror
                    
                    
                            <textarea wire:model="editDescription" class="w-full px-2 py-1 border rounded"></textarea>
                            <div class="flex space-x-2">
                                <button wire:click="updateTodo" class="px-3 py-1 bg-green-500 text-white rounded">حفظ</button>
                                <button wire:click="cancelEdit" class="px-3 py-1 bg-gray-500 text-white rounded">إلغاء</button>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-800 font-medium">{{ $todo->title }}</p>
                        <p class="text-sm text-gray-500 mt-1">{{ $todo->description }}</p>
                        <p class="text-xs text-gray-400 mt-2">{{ $todo->created_at }}</p>
                    @endif
                </div>
                <div class="flex space-x-2 space-x-reverse">
                    <!-- أيقونة التعديل -->
                    <button wire:click="editTodo({{ $todo->id }})" class="text-blue-500 hover:text-blue-700 p-1 rounded-full hover:bg-blue-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </button>
                    <!-- أيقونة الحذف -->
                    <button wire:click="$dispatch('deleteConfirm',{{ $todo->id}})"
                        class="text-red-500 hover:text-red-700 p-1 rounded-full hover:bg-red-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @script
    <script>
        Livewire.on('deleted', () => {
            Swal.fire("تم الحذف!", "تم حذف المهمة بنجاح.", "success");
        });
        
        Livewire.on('deleteConfirm', (id) => {
            if (typeof Swal !== "undefined") {
                Swal.fire({
                    title: "هل أنت متأكد؟",
                    text: "لن تتمكن من استعادة هذا العنصر بعد الحذف!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "نعم، احذف!",
                    cancelButtonText: "إلغاء"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('deleteTodo', {id: id});
                    }
                });
            } else {
                console.error("SweetAlert is missing!");
            }
        });
    </script>
    @endscript
</div>