/* global Stripe */
/* global fetch */
/* global URLSearchParams */

document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("#payment-form");

  if (!form) {
    console.error("❌ Erreur : Formulaire introuvable !");
    return;
  }

  form.addEventListener("submit", handleSubmit);
  initialize();
});

// 🔹 Initialisation de Stripe avec la clé publique
const stripe = Stripe(
  "pk_test_51QoLcd06lXvMljmwSKKtwwMtj3z04LLykRipz70079MdgoRTmGHORbOstEgWT4M7xOfhDNj1rbrEongnNcZcViHl00C9xMxze5"
); // Remplace par ta vraie clé publique

let amount = 1; // Montant par défaut
let elements;

// 🔄 Fonction pour initialiser le paiement
async function initialize() {
  try {
    console.log("🔄 Initialisation du paiement...");

    if (!amount || isNaN(amount) || amount < 1) {
      console.error("❌ Montant invalide :", amount);
      return;
    }

    const response = await fetch("../app/controllers/create.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ amount }),
    });

    if (!response.ok) {
      throw new Error("❌ Erreur serveur : " + response.status);
    }

    const data = await response.json();
    console.log("✅ Réponse serveur :", data);

    if (!data.clientSecret) {
      throw new Error("❌ clientSecret non reçu !");
    }

    elements = stripe.elements({ clientSecret: data.clientSecret });
    const paymentElement = elements.create("payment");
    paymentElement.mount("#payment-element");

    document.querySelector("#submit").disabled = false;
    document.querySelector("#button-text").textContent =
      "Don de " + amount + "€";
  } catch (error) {}
}

// 🔄 Écouteur pour mettre à jour le montant de la donation
document
  .getElementById("donation-amount")
  .addEventListener("change", function (event) {
    amount = parseInt(event.target.value);
    if (amount >= 1) {
      initialize();
    }
  });
function setLoading(isLoading) {
  const buttonSubmit = document.querySelector("#submit");

  if (isLoading) {
    buttonSubmit.disabled = true;
    document.querySelector("#spinner").classList.remove("hidden");
    document.querySelector("#button-text").classList.add("hidden");
  } else {
    buttonSubmit.disabled = false;
    document.querySelector("#spinner").classList.add("hidden");
    document.querySelector("#button-text").classList.remove("hidden");
  }
}

// 🛠 Gestion du formulaire de paiement
async function handleSubmit(e) {
  e.preventDefault();
  setLoading(true);

  const { error } = await stripe.confirmPayment({
    elements,
    confirmParams: {
      return_url:
        "http://localhost/BRE03-PHP/bre03-donate-for-ducks/public/views/checkout.html",
    },
  });

  if (error) {
    showMessage(error.message || "Une erreur inattendue s'est produite.");
  }

  setLoading(false);
}
