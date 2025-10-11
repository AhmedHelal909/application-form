import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
import intlTelInput from 'intl-tel-input';
import 'intl-tel-input/build/css/intlTelInput.css';

document.addEventListener("DOMContentLoaded", () => {
    const phoneInputField = document.querySelector("#phone");

    if (phoneInputField) {
        const iti = intlTelInput(phoneInputField, {
            initialCountry: "eg", // ممكن تخليها auto لو عايز
            preferredCountries: ["eg", "us", "gb", "sa", "ae"],
            separateDialCode: true,
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.0/build/js/utils.js",
        });

        // خزن الرقم بصيغة دولية قبل الإرسال
        const form = document.querySelector("#applicationForm");
        form?.addEventListener("submit", function(e) {
            const hiddenInput = document.querySelector("#full_phone");
            if (hiddenInput) {
                hiddenInput.value = iti.getNumber(); // +20123456789
            }
        });
    }
});
