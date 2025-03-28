<!-- نموذج الإضافة -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2">عنوان المهمة</label>
        <input type="text" wire:model='title'
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="أدخل عنوان المهمة...">


        @error('title')
        <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span>
        @enderror

    </div>
    <div class=" mb-4">
        <label class="block text-gray-700 font-medium mb-2">وصف المهمة</label>
        <textarea wire:model='description'
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            rows="3" placeholder="أدخل وصف المهمة..."></textarea>


        @error('description')
        <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span>
        @enderror
    </div>
    <button wire:click.prevent='create' wire:loading.attr="disabled"
        class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                clip-rule="evenodd" />
        </svg>
        إنشاء مهمة
    </button>
    <div wire:loading class="text-green-600">
        حفظ المهمة ...
    </div>
    @if (session('success'))
    <div x-data="{ show: true }" x-show="show" class="bg-green-300 text-black p-2 mt-3 rounded-md shadow-md relative">
        <span> {{ session('success') }}</span>
        <button @click="show = false" class="absolute top-1 left-2 text-black text-lg font-bold">
            &times;
        </button>
    </div>
    @endif
</div>