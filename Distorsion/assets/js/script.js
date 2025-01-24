document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("messageForm");
  const messageInput = document.getElementById("messageInput");
  const chatMessages = document.querySelector(".chat-messages");

  form.addEventListener("submit", function (event) {
    event.preventDefault(); // Empêche le refresh
    const roomId = form.querySelector('[name="room_id"]').value;
    const content = messageInput.value.trim();

    if (content !== "") {
      // Envoi en AJAX (Fetch)
      fetch("/distorsion/?controller=message&action=add", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({
          room_id: roomId,
          content: content,
        }),
      })
        .then((response) => response.json()) // Attendre la réponse en JSON
        .then((data) => {
          if (data.success) {
            // Créer l’élément message dans la liste
            const newMessage = document.createElement("div");
            newMessage.classList.add("message");
            newMessage.innerHTML = `
              <strong>User${data.userId}:</strong> 
              ${data.content}
              <div class="timestamp">${data.createdAt}</div>
            `;
            chatMessages.appendChild(newMessage);

            // Scroller vers le bas
            chatMessages.scrollTop = chatMessages.scrollHeight;
          } else {
            console.error(data.error);
          }
        })
        .catch((err) => console.error(err));

      // Reset input
      messageInput.value = "";
    }
  });
});
