<x-admin-layout>
    <div class="mb-6">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Database Peraturan & Putusan') }}
        </h2>
    </div>

    <div>
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    
                    <div class="text-center mb-10">
                        <h3 class="text-2xl font-bold mb-2">Pusat Riset Hukum Terpadu</h3>
                        <p class="text-gray-500 dark:text-gray-400">Telusuri jutaan peraturan perundang-undangan dan putusan pengadilan langsung dari sumber resmi pemerintah Indonesia.</p>
                    </div>

                    <div class="max-w-4xl mx-auto">
                        <form id="searchForm" class="space-y-6" onsubmit="event.preventDefault(); performSearch();">
                            
                            <!-- Search Input -->
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text" id="searchQuery" required class="block w-full pl-10 pr-3 py-4 border border-gray-300 dark:border-gray-600 rounded-lg leading-5 bg-white dark:bg-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-lg transition duration-150 ease-in-out" placeholder="Contoh: Pencurian Motor, Pajak Kendaraan...">
                            </div>

                            <!-- Source Selection -->
                            <div class="grid grid-cols-2 gap-4">
                                <label class="relative flex flex-col bg-gray-50 dark:bg-gray-900 p-4 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 focus-within:ring-2 focus-within:ring-blue-500">
                                    <input type="radio" name="searchType" value="peraturan" class="sr-only" checked onchange="updateUI()">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-semibold text-gray-900 dark:text-white">Peraturan</span>
                                        <svg class="h-5 w-5 text-blue-500 hidden check-icon" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <p class="text-xs text-gray-500">JDIHN (UU, PP, Perpres, dll)</p>
                                </label>

                                <label class="relative flex flex-col bg-gray-50 dark:bg-gray-900 p-4 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 focus-within:ring-2 focus-within:ring-blue-500">
                                    <input type="radio" name="searchType" value="putusan" class="sr-only" onchange="updateUI()">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-semibold text-gray-900 dark:text-white">Putusan</span>
                                        <svg class="h-5 w-5 text-blue-500 hidden check-icon" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <p class="text-xs text-gray-500">Direktori Putusan MA</p>
                                </label>
                            </div>

                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                Mulai Pencarian
                            </button>
                        </form>

                        <div id="resultsContainer" class="mt-12 hidden">
                            <h4 class="text-lg font-bold mb-4 border-b pb-2 text-gray-800 dark:text-gray-200">Hasil Pencarian:</h4>
                            <!-- Iframe Container for embedding results directly -->
                            <div class="w-full h-[700px] bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden relative">
                                <div id="loadingSpinner" class="absolute inset-0 flex items-center justify-center bg-gray-50/80 dark:bg-gray-900/80 z-10 hidden">
                                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
                                </div>
                                <iframe id="resultIframe" class="w-full h-full border-0" sandbox="allow-same-origin allow-scripts allow-popups allow-forms"></iframe>
                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function updateUI() {
            const labels = document.querySelectorAll('label');
            labels.forEach(label => {
                const radio = label.querySelector('input[type="radio"]');
                const icon = label.querySelector('.check-icon');
                if (radio.checked) {
                    label.classList.add('border-blue-500', 'ring-1', 'ring-blue-500');
                    label.classList.remove('border-gray-200', 'dark:border-gray-700');
                    icon.classList.remove('hidden');
                } else {
                    label.classList.remove('border-blue-500', 'ring-1', 'ring-blue-500');
                    label.classList.add('border-gray-200', 'dark:border-gray-700');
                    icon.classList.add('hidden');
                }
            });
        }

        // Initialize UI
        updateUI();

        function performSearch() {
            const query = document.getElementById('searchQuery').value;
            const type = document.querySelector('input[name="searchType"]:checked').value;
            
            if (!query) return;

            let url = '';
            if (type === 'peraturan') {
                // JDIHN search
                url = `https://jdihn.go.id/pencarian?keyword=${encodeURIComponent(query)}`;
            } else {
                // Mahkamah Agung search
                url = `https://putusan3.mahkamahagung.go.id/search.html?q=${encodeURIComponent(query)}`;
            }

            // Show container and loading spinner
            document.getElementById('resultsContainer').classList.remove('hidden');
            document.getElementById('loadingSpinner').classList.remove('hidden');
            
            const iframe = document.getElementById('resultIframe');
            
            // Hide spinner when iframe loads
            iframe.onload = function() {
                document.getElementById('loadingSpinner').classList.add('hidden');
            };
            
            // Set source
            iframe.src = url;
        }
    </script>
</x-admin-layout>
