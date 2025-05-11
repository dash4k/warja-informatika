document.addEventListener('DOMContentLoaded', () => {
    const profilePicture = document.getElementById('profilePicture');
    const profilePreview = document.getElementById('profilePreview');
    const profileValue = profilePicture.value;
    const profilePath = profilePreview.src;
    const errorPfp = document.getElementById('profilePictureErrorMessage');
    const PfpLabel = document.getElementById('profilePictureLabel');
    
    const nama = document.getElementById('namaLengkap');
    const errorNama = document.getElementById('namaLengkapErrorMessage');
    const namaLabel = document.getElementById('namaLengkapLabel');

    const biodata = document.getElementById('biodataForm');

    const nameRegex = /^[\p{L}\p{M}' -]+$/u

    function previewPfp(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                profilePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    function validateName() {
        const nameValue = nama.value.trim();

        if (!nameRegex.test(nameValue)) {
            nama.classList.add('border-2');
            nama.classList.add('border-red-500');
            namaLabel.classList.remove('text-gray-400');
            namaLabel.classList.add('text-red-500');
            errorNama.innerText = "Format nama salah!";
            return false;
        }
        else {
            nama.classList.remove('border-2');
            nama.classList.remove('border-red-500');
            namaLabel.classList.add('text-gray-400');
            namaLabel.classList.remove('text-red-500');
            errorNama.innerText = "";
            return true;
        }
    }

    function validatePfp() {
        const file = profilePicture.files[0];
        if (!file) {
            errorPfp.innerText = "";
            return true;
        }

        const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        const maxSize = 2 *1024 * 1024;

        if (!validTypes.includes(file.type)) {
            errorPfp.innerText = "File harus berupa PNG, JPG atau JPEG!";
            profilePicture.value = profileValue;
            PfpLabel.classList.add('border-red-500');
            PfpLabel.classList.add('bg-red-50');
            PfpLabel.classList.add('hover:bg-red-100');
            PfpLabel.classList.remove('hover:bg-gray-100');
            PfpLabel.classList.remove('bg-gray-50');
            PfpLabel.classList.remove('border-gray-300');
            profilePreview.src = profilePath;
            return false
        }

        if (file.size > maxSize) {
            errorPfp.innerText = "Ukuran file maksimal 2MB!";
            profilePicture.value = profileValue;
            PfpLabel.classList.add('border-red-500');
            PfpLabel.classList.add('bg-red-50');
            PfpLabel.classList.add('hover:bg-red-100');
            PfpLabel.classList.remove('hover:bg-gray-100');
            PfpLabel.classList.remove('bg-gray-50');
            PfpLabel.classList.remove('border-gray-300');
            profilePreview.src = profilePath;
            return false
        }

        PfpLabel.classList.remove('border-red-500');
        PfpLabel.classList.remove('bg-red-50');
        PfpLabel.classList.remove('hover:bg-red-100');
        PfpLabel.classList.add('hover:bg-gray-100');
        PfpLabel.classList.add('bg-gray-50');
        PfpLabel.classList.add('border-gray-300');
        errorPfp.innerText = '';
        return true;
    }

    profilePicture.addEventListener('change', function(event) {
        if (validatePfp()) {
            previewPfp(event);
        }
    });
    nama.addEventListener('input', validateName);

    biodata.addEventListener('submit', function (event) {
        const validName = validateName();
        const validPfp = validatePfp();
        
        if (!validName || !validPfp) {
            event.preventDefault();
        }
    })

});