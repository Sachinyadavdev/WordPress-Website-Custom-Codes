<script>
document.addEventListener("DOMContentLoaded", function () {
    // Map English → Tamil
    const enToTa = {
        "https://tnyouthfornature.org/": "https://tnyouthfornature.org/tamil/",
        "https://tnyouthfornature.org/about-us/": "https://tnyouthfornature.org/about-us-tamil/",
        "https://tnyouthfornature.org/gallery/": "https://tnyouthfornature.org/gallery-tamil/",
        "https://tnyouthfornature.org/support/": "https://tnyouthfornature.org/support-tamil/",
        "https://tnyouthfornature.org/privacy-policy/": "https://tnyouthfornature.org/privacy-policy-tamil/",
        "https://tnyouthfornature.org/terms-and-conditions/": "https://tnyouthfornature.org/terms-and-conditions-tamil/",
        "https://tnyouthfornature.org/faqs/": "https://tnyouthfornature.org/faq-tamil/",
        "https://tnyouthfornature.org/delete-account/": "https://tnyouthfornature.org/delete-account-tamil/"
    };

    // Map Tamil → English
    const taToEn = {};
    for (let key in enToTa) {
        taToEn[enToTa[key]] = key;
    }

    // Current page
    let currentUrl = window.location.href;

    // Normalize (remove trailing slash issues)
    if (!currentUrl.endsWith("/")) {
        currentUrl += "/";
    }

    // Get translate button
    const btn = document.querySelector(".translateID");
    if (btn) {
        if (enToTa[currentUrl]) {
            btn.href = enToTa[currentUrl]; // English → Tamil
        } else if (taToEn[currentUrl]) {
            btn.href = taToEn[currentUrl]; // Tamil → English
        } else {
            // Default fallback → Tamil Home
            btn.href = "https://tnyouthfornature.org/tamil/";
        }
    }
});
</script>
