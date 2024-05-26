<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-indigo-600 dark:bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 dark:hover:bg-indigo-700 focus:bg-indigo-400 ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
