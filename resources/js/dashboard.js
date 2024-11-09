import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: process.env.VITE_PUSHER_APP_KEY,
    cluster: process.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

document.addEventListener("DOMContentLoaded", function () {
    // Fetch initial user count
    async function fetchUserCount() {
        const response = await fetch('/user-count');
        const data = await response.json();
        document.getElementById("userCount").textContent = data.count;
    }

    fetchUserCount();

    // Listen for UserDeleted event
    window.Echo.channel("user-channel")
        .listen(".UserDeleted", (event) => {
            document.getElementById("userCount").textContent = event.userCount;
        });
});
