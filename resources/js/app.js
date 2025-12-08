import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Mobile sidebar toggle accessibility
document.addEventListener('DOMContentLoaded', function () {
	const mobileBtn = document.getElementById('mobile-menu-btn');
	const sidebar = document.getElementById('sidebar');

	if (!mobileBtn || !sidebar) return;

	mobileBtn.addEventListener('click', function () {
		const isActive = sidebar.classList.toggle('active');
		// update ARIA attributes for accessibility
		mobileBtn.setAttribute('aria-expanded', String(isActive));
		sidebar.setAttribute('aria-hidden', String(!isActive));
	});
});
