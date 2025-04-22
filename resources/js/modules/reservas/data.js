import flatpickr from "flatpickr";
import { Portuguese } from "flatpickr/dist/l10n/pt.js";

export default function() {
    flatpickr("#data", {
        locale: Portuguese,
        disable: [
            function(date) {
                return date.getDay() === 1; // Desabilita segundas-feiras
            }
        ],
        minDate: "today",
        dateFormat: "d/m/Y"
    });
}
