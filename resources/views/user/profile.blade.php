@include('user.header')

<style>
.profile-grid {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 24px;
    margin-bottom: 28px;
}
@media(max-width:900px){ .profile-grid{ grid-template-columns:1fr; } }

/* avatar card */
.avatar-card {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 32px 24px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}
.profile-avatar {
    width: 90px; height: 90px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), #7c3aed);
    display: flex; align-items: center; justify-content: center;
    font-size: 2rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 16px;
    position: relative;
}
.avatar-badge {
    position: absolute;
    bottom: 2px; right: 2px;
    width: 22px; height: 22px;
    border-radius: 50%;
    background: var(--green);
    border: 2px solid var(--card-bg);
    display: flex; align-items: center; justify-content: center;
    font-size: .65rem;
    color: #fff;
}
.profile-name { font-size: 1.1rem; font-weight: 700; margin-bottom: 4px; }
.profile-role {
    font-size: .78rem;
    color: var(--primary);
    background: var(--primary-dim);
    border-radius: 20px;
    padding: 3px 12px;
    font-weight: 600;
    display: inline-block;
    margin-bottom: 20px;
}
.profile-meta {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 12px;
    border-top: 1px solid var(--border);
    padding-top: 20px;
}
.meta-row {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: .82rem;
    color: var(--text-muted);
}
.meta-row i { font-size: 1rem; width: 18px; flex-shrink: 0; }
.meta-row span { word-break: break-all; }

/* stats row */
.profile-stats {
    display: grid;
    grid-template-columns: repeat(3,1fr);
    gap: 14px;
    margin-bottom: 20px;
}
@media(max-width:580px){ .profile-stats{ grid-template-columns:1fr 1fr; } }
.pstat {
    background: var(--card-alt);
    border-radius: 10px;
    padding: 14px 12px;
    text-align: center;
}
.pstat-val { font-size: 1.15rem; font-weight: 700; }
.pstat-lbl { font-size: .75rem; color: var(--text-muted); margin-top: 2px; }

/* form */
.form-group  { margin-bottom: 18px; }
.form-label  { font-size: .85rem; color: var(--text-muted); margin-bottom: 6px; display: block; }
.form-control-dark {
    width: 100%;
    background: var(--card-alt);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 10px;
    color: var(--text);
    padding: 12px 14px;
    font-size: .95rem;
    outline: none;
    transition: border .2s;
    box-sizing: border-box;
}
.form-control-dark:focus { border-color: var(--primary); }
.form-control-dark:disabled {
    opacity: .55;
    cursor: not-allowed;
}

.form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
@media(max-width:580px){ .form-row-2{ grid-template-columns:1fr; } }

.save-btn {
    padding: 12px 28px;
    border: none;
    border-radius: 10px;
    background: var(--primary);
    color: #fff;
    font-size: .92rem;
    font-weight: 600;
    cursor: pointer;
    transition: opacity .2s;
}
.save-btn:hover { opacity: .88; }

.danger-btn {
    padding: 12px 28px;
    border: 1.5px solid var(--red);
    border-radius: 10px;
    background: transparent;
    color: var(--red);
    font-size: .92rem;
    font-weight: 600;
    cursor: pointer;
    transition: background .2s, color .2s;
}
.danger-btn:hover { background: var(--red); color: #fff; }

/* section tabs */
.profile-tabs {
    display: flex;
    gap: 8px;
    margin-bottom: 22px;
    border-bottom: 1px solid var(--border);
    padding-bottom: 0;
    flex-wrap: wrap;
}
.ptab {
    padding: 10px 18px;
    font-size: .88rem;
    font-weight: 500;
    color: var(--text-muted);
    cursor: pointer;
    border-bottom: 2px solid transparent;
    margin-bottom: -1px;
    transition: color .2s, border-color .2s;
    user-select: none;
}
.ptab:hover  { color: var(--text); }
.ptab.active { color: var(--primary); border-bottom-color: var(--primary); font-weight: 600; }

.tab-panel { display: none; }
.tab-panel.active { display: block; }

/* security notice */
.security-notice {
    background: rgba(79,142,247,.07);
    border: 1px solid rgba(79,142,247,.2);
    border-radius: 10px;
    padding: 12px 16px;
    font-size: .82rem;
    color: var(--text-muted);
    margin-bottom: 20px;
    display: flex;
    gap: 10px;
    align-items: flex-start;
}
.security-notice i { color: var(--primary); font-size: 1rem; flex-shrink: 0; margin-top: 1px; }
</style>

        <main class="main-content">

            <div class="profile-grid">

                <!-- Left: Avatar + Meta -->
                <div class="avatar-card fade-in">
                    <div class="profile-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        <div class="avatar-badge"><i class="bi bi-check"></i></div>
                    </div>
                    <div class="profile-name">{{ Auth::user()->name }}</div>
                    <div class="profile-role">Investor Account</div>

                    <div class="profile-stats">
                        <div class="pstat">
                            <div class="pstat-val" style="color:var(--green);">$0.00</div>
                            <div class="pstat-lbl">Balance</div>
                        </div>
                        <div class="pstat">
                            <div class="pstat-val" style="color:var(--primary);">$0.00</div>
                            <div class="pstat-lbl">Deposited</div>
                        </div>
                        <div class="pstat">
                            <div class="pstat-val" style="color:var(--gold);">$0.00</div>
                            <div class="pstat-lbl">Withdrawn</div>
                        </div>
                    </div>

                    <div class="profile-meta">
                        <div class="meta-row">
                            <i class="bi bi-envelope" style="color:var(--primary);"></i>
                            <span>{{ Auth::user()->email }}</span>
                        </div>
                        <div class="meta-row">
                            <i class="bi bi-calendar3" style="color:var(--text-muted);"></i>
                            <span>Joined {{ Auth::user()->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="meta-row">
                            <i class="bi bi-shield-check" style="color:var(--green);"></i>
                            <span style="color:var(--green);">Account Verified</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Tabs + Forms -->
                <div class="dash-card fade-in">

                    <div class="profile-tabs">
                        <div class="ptab active" onclick="switchTab('personal')">
                            <i class="bi bi-person me-1"></i>Personal Info
                        </div>
                        <div class="ptab" onclick="switchTab('security')">
                            <i class="bi bi-lock me-1"></i>Security
                        </div>
                    </div>

                    <!-- Personal Info Tab -->
                    <div class="tab-panel active" id="tab-personal">
                        <form action="#" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-row-2">
                                <div class="form-group">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control-dark" name="name"
                                           value="{{ Auth::user()->name }}" placeholder="Your full name">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control-dark" name="email"
                                           value="{{ Auth::user()->email }}" disabled>
                                    <small style="font-size:.75rem;color:var(--text-muted);margin-top:4px;display:block;">
                                        Contact support to change your email.
                                    </small>
                                </div>
                            </div>

                            <div class="form-row-2">
                                <div class="form-group">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control-dark" name="phone"
                                           placeholder="+1 (555) 000-0000">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Country</label>
                                    <select class="form-control-dark" name="country">
                                        <option value="">Select country</option>
                                        <option>United States</option>
                                        <option>United Kingdom</option>
                                        <option>Canada</option>
                                        <option>Australia</option>
                                        <option>Germany</option>
                                        <option>France</option>
                                        <option>UAE</option>
                                        <option>Nigeria</option>
                                        <option>South Africa</option>
                                        <option>India</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Bitcoin Wallet Address (for payouts)</label>
                                <input type="text" class="form-control-dark" name="btc_wallet"
                                       placeholder="Enter your BTC wallet address">
                            </div>

                            <div class="form-group">
                                <label class="form-label">USDT Wallet Address (TRC-20)</label>
                                <input type="text" class="form-control-dark" name="usdt_wallet"
                                       placeholder="Enter your USDT (TRC-20) wallet address">
                            </div>

                            <div style="display:flex;justify-content:flex-end;">
                                <button type="submit" class="save-btn">
                                    <i class="bi bi-check2 me-1"></i>Save Changes
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Security Tab -->
                    <div class="tab-panel" id="tab-security">

                        <div class="security-notice">
                            <i class="bi bi-info-circle-fill"></i>
                            Use a strong, unique password you don't use on other sites. We recommend at least 12 characters with numbers and symbols.
                        </div>

                        <form action="#" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="form-label">Current Password</label>
                                <input type="password" class="form-control-dark" name="current_password"
                                       placeholder="Enter your current password">
                            </div>

                            <div class="form-row-2">
                                <div class="form-group">
                                    <label class="form-label">New Password</label>
                                    <input type="password" class="form-control-dark" name="password"
                                           placeholder="At least 8 characters">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control-dark" name="password_confirmation"
                                           placeholder="Repeat new password">
                                </div>
                            </div>

                            <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
                                <button type="button" class="danger-btn" onclick="confirmLogoutAll()">
                                    <i class="bi bi-box-arrow-right me-1"></i>Sign Out All Devices
                                </button>
                                <button type="submit" class="save-btn">
                                    <i class="bi bi-shield-lock me-1"></i>Update Password
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </main>

<script>
function switchTab(name) {
    document.querySelectorAll('.ptab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelector('[onclick="switchTab(\'' + name + '\')"]').classList.add('active');
    document.getElementById('tab-' + name).classList.add('active');
}

function confirmLogoutAll() {
    if (confirm('This will sign you out of all active sessions. Continue?')) {
        // submit logout-all request
    }
}
</script>

@include('user.footer')
