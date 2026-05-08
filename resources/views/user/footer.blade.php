        <!-- Mobile Bottom Navigation -->
        <nav class="mobile-nav">
            <a href="#" class="mobile-nav-item active">
                <i class="bi bi-speedometer2"></i><span>Dashboard</span>
            </a>
            <a href="#" class="mobile-nav-item">
                <i class="bi bi-cash-coin"></i><span>Deposit</span>
            </a>
            <a href="#" class="mobile-nav-item">
                <i class="bi bi-graph-up-arrow"></i><span>Invest</span>
            </a>
            <a href="#" class="mobile-nav-item">
                <i class="bi bi-arrow-up-circle"></i><span>Withdraw</span>
            </a>
            <a href="#" class="mobile-nav-item">
                <i class="bi bi-person-circle"></i><span>Profile</span>
            </a>
        </nav>
    </div><!-- /.dashboard-container -->

    <!-- Dashboard JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initSidebarToggle();
            initDropdown();
            initMobileNavigation();
            updateCurrentDate();
        });

        function initSidebarToggle() {
            const navToggle = document.getElementById('navToggle');
            const sidebar   = document.getElementById('sidebar');
            const overlay   = document.getElementById('sidebarOverlay');
            if (!navToggle || !sidebar || !overlay) return;

            navToggle.addEventListener('click', function (e) {
                e.stopPropagation();
                const open = sidebar.classList.toggle('active');
                overlay.classList.toggle('active', open);
                document.body.style.overflow = open ? 'hidden' : '';
                navToggle.querySelector('i').className = open ? 'bi bi-x-lg' : 'bi bi-list';
            });

            overlay.addEventListener('click', function () {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
                navToggle.querySelector('i').className = 'bi bi-list';
            });

            document.querySelectorAll('.nav-item').forEach(item => {
                item.addEventListener('click', function () {
                    if (window.innerWidth < 992) {
                        sidebar.classList.remove('active');
                        overlay.classList.remove('active');
                        document.body.style.overflow = '';
                        navToggle.querySelector('i').className = 'bi bi-list';
                    }
                });
            });

            window.addEventListener('resize', function () {
                if (window.innerWidth >= 992) {
                    sidebar.classList.add('active');
                    overlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });

            if (window.innerWidth >= 992) sidebar.classList.add('active');
        }

        function initDropdown() {
            const btn  = document.getElementById('userDropdownBtn');
            const menu = document.getElementById('dropdownMenu');
            if (!btn || !menu) return;

            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                menu.classList.toggle('show');
            });

            document.addEventListener('click', function (e) {
                if (!btn.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.remove('show');
                }
            });
        }

        function initMobileNavigation() {
            const items = document.querySelectorAll('.mobile-nav-item');
            items.forEach(item => {
                item.addEventListener('click', function (e) {
                    e.preventDefault();
                    items.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        }

        function updateCurrentDate() {
            const el = document.getElementById('currentDate');
            if (!el) return;
            const now = new Date();
            el.textContent = 'Here\'s your investment overview for ' + now.toLocaleDateString('en-US', { weekday:'long', year:'numeric', month:'long', day:'numeric' });
        }
    </script>
</body>
</html>
