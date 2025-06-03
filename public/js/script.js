// Theme toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('loader').style.display = 'none';
    const themeToggle = document.createElement('button');
    themeToggle.className = 'theme-toggle';
    themeToggle.innerHTML = '<i class="bi bi-moon-fill"></i>';
    document.body.appendChild(themeToggle);
    
    const savedTheme = localStorage.getItem('theme') || 
                      (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    
    if (savedTheme === 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark');
        themeToggle.innerHTML = '<i class="bi bi-sun-fill"></i>';
    }
    
    themeToggle.addEventListener('click', () => {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        if (currentTheme === 'dark') {
            document.documentElement.removeAttribute('data-theme');
            localStorage.setItem('theme', 'light');
            themeToggle.innerHTML = '<i class="bi bi-moon-fill"></i>';
        } else {
            document.documentElement.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
            themeToggle.innerHTML = '<i class="bi bi-sun-fill"></i>';
        }
    });

    if(document.getElementById('sidebarToggle')){
        const sidebar = document.getElementById('sidebar');
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            if(sidebar.classList.contains('active')){                
                sidebar.classList.remove('active');
            }else{
                sidebar.classList.add('active');
            }
        });
    }

    setInterval(function () {
        fetch('/refresh-csrf').then(res => res.json()).then(data => {
            const meta = document.querySelector('meta[name="csrf-token"]');
            if (meta) meta.setAttribute('content', data.csrf_token);
            const inputs = document.querySelectorAll("input[name='_token']");
            if (inputs) {
                inputs.forEach(el => {
                    el.value = data.csrf_token;
                });
            }
        });
    }, 10 * 60 * 1000);
});