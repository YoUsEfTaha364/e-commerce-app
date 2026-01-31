const searchInput = document.getElementById('search');
const suggestions = document.getElementById('suggestions');
const searchForm = document.getElementById('searchForm');

searchInput.addEventListener('keyup', function() {
    let keyword = this.value;

    if (keyword.length < 1) {
        suggestions.innerHTML = '';
        suggestions.classList.add('hidden');
        return;
    }

    fetch(`/search/suggestions?q=${keyword}`)
        .then(res => res.json())
        .then(data => {
            
            let list = '';
            data.forEach(item => {
                list += `
<li class="flex items-center px-3 py-2 hover:bg-gray-100 cursor-pointer">
    <i class="fas fa-search text-gray-400 mr-3"></i>
    <span class="text-gray-700">${item.name}</span>
</li>`;
            });

            suggestions.innerHTML = list;
            suggestions.classList.remove('hidden');
        });
});

// When clicking a suggestion → fill input + submit form
suggestions.addEventListener('click', function(e) {
    if (e.target.tagName === 'SPAN') {
        searchInput.value = e.target.innerText;
    } 
    else if (e.target.tagName === 'LI') {
        searchInput.value = e.target.innerText.trim();
    }

    suggestions.classList.add('hidden');
    searchForm.submit();  // ⭐ submit form to Laravel
});

// Hide dropdown on blur
searchInput.addEventListener('blur', function() {
    setTimeout(() => suggestions.classList.add('hidden'), 200);
});

// Show again when typing
searchInput.addEventListener('focus', function() {
    if (suggestions.innerHTML.trim() !== '') {
        suggestions.classList.remove('hidden');
    }
});
