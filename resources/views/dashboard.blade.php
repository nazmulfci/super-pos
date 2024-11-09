<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Total user: <span id="userCount">0</span>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/@reverb/reverb"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@logue/reverb@1.3.11/dist/Reverb.iife.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Fetch the initial user count
            async function fetchUserCount() {
                const response = await fetch('/user-count');
                const data = await response.json();
                document.getElementById("userCount").textContent = data.count;
            }

            // Load the initial user count on page load
            fetchUserCount();

            // Set up Reverb to listen for the UserDeleted event
            const reverb = new Reverb("public");

            reverb.listen("UserDeleted", (event) => {
                // Update the user count in real-time
                document.getElementById("userCount").textContent = event.userCount;
            });
        });
    </script>
</x-app-layout>
