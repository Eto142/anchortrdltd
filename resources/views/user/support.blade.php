@include('user.header')

<style>
.support-grid {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 24px;
    margin-bottom: 28px;
}
@media(max-width:960px){ .support-grid{ grid-template-columns:1fr; } }

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
    resize: vertical;
}
.form-control-dark:focus { border-color: var(--primary); }
.form-control-dark option { background: var(--card-bg); }

.submit-btn {
    width: 100%;
    padding: 13px;
    border: none;
    border-radius: 10px;
    background: var(--primary);
    color: #fff;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: opacity .2s;
    margin-top: 4px;
}
.submit-btn:hover { opacity: .88; }

/* priority badges */
.prio-grid {
    display: grid;
    grid-template-columns: repeat(3,1fr);
    gap: 10px;
    margin-bottom: 18px;
}
.prio-card {
    border: 2px solid transparent;
    background: var(--card-alt);
    border-radius: 10px;
    padding: 12px 8px;
    text-align: center;
    cursor: pointer;
    transition: all .2s;
    user-select: none;
}
.prio-card:hover  { border-color: var(--primary); }
.prio-card.active { border-color: var(--primary); background: rgba(79,142,247,.1); }
.prio-icon { font-size: 1.3rem; margin-bottom: 4px; }
.prio-lbl  { font-size: .75rem; font-weight: 600; color: var(--text-muted); }

/* contact cards */
.contact-card {
    background: var(--card-alt);
    border-radius: 12px;
    padding: 18px;
    display: flex;
    align-items: flex-start;
    gap: 14px;
    margin-bottom: 12px;
    transition: background .2s;
}
.contact-card:last-child { margin-bottom: 0; }
.contact-card:hover { background: rgba(79,142,247,.07); }
.contact-icon {
    width: 42px; height: 42px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.15rem;
    flex-shrink: 0;
}
.contact-title { font-size: .9rem; font-weight: 600; margin-bottom: 3px; }
.contact-val   { font-size: .82rem; color: var(--primary); text-decoration: none; word-break: break-all; }
.contact-val:hover { text-decoration: underline; }
.contact-sub   { font-size: .75rem; color: var(--text-muted); margin-top: 2px; }

/* FAQ */
.faq-item {
    border-bottom: 1px solid var(--border);
}
.faq-item:last-child { border-bottom: none; }
.faq-question {
    padding: 14px 0;
    font-size: .9rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    user-select: none;
}
.faq-question i { font-size: .85rem; color: var(--text-muted); transition: transform .2s; flex-shrink: 0; }
.faq-answer {
    font-size: .83rem;
    color: var(--text-muted);
    line-height: 1.65;
    max-height: 0;
    overflow: hidden;
    transition: max-height .3s ease, padding .3s ease;
}
.faq-answer.open { max-height: 300px; padding-bottom: 14px; }
.faq-question.open i { transform: rotate(180deg); }

/* ticket history */
.ticket-item {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    padding: 14px 0;
    border-bottom: 1px solid var(--border);
    gap: 12px;
}
.ticket-item:last-child { border-bottom: none; padding-bottom: 0; }
.ticket-badge {
    font-size: .72rem;
    padding: 3px 9px;
    border-radius: 20px;
    font-weight: 600;
    white-space: nowrap;
}
.ticket-badge.open     { background: rgba(79,142,247,.15);  color: var(--primary); }
.ticket-badge.resolved { background: rgba(0,200,150,.15);   color: var(--green); }
.ticket-badge.pending  { background: rgba(245,166,35,.15);  color: var(--gold); }

.empty-state { text-align: center; padding: 32px 0; color: var(--text-muted); }
.empty-state i { font-size: 2.2rem; display: block; margin-bottom: 10px; opacity: .3; }
.empty-state p { font-size: .83rem; margin: 0; }

/* status notice */
.status-notice {
    background: rgba(0,200,150,.07);
    border: 1px solid rgba(0,200,150,.2);
    border-radius: 10px;
    padding: 12px 16px;
    font-size: .82rem;
    color: var(--text-muted);
    margin-bottom: 20px;
    display: flex;
    gap: 10px;
    align-items: center;
}
.status-notice i { color: var(--green); font-size: 1rem; flex-shrink: 0; }
</style>

        <main class="main-content">

            <div class="support-grid">

                <!-- Left: Ticket Form + FAQ -->
                <div style="display:flex;flex-direction:column;gap:24px;">

                    <!-- Submit Ticket -->
                    <div class="dash-card fade-in">
                        <div class="card-header">
                            <h3><i class="bi bi-headset me-2" style="color:var(--primary);"></i>Submit a Support Ticket</h3>
                        </div>

                        <div class="status-notice">
                            <i class="bi bi-clock-fill"></i>
                            Average response time: <strong style="color:var(--green);margin:0 4px;">15 – 30 minutes</strong> &mdash; Our team is available 24/7.
                        </div>

                        <form action="#" method="POST">
                            @csrf

                            <div class="form-group">
                                <label class="form-label">Subject</label>
                                <input type="text" class="form-control-dark" name="subject"
                                       placeholder="Briefly describe your issue">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Category</label>
                                <select class="form-control-dark" name="category">
                                    <option value="">Select a category</option>
                                    <option>Deposit Issue</option>
                                    <option>Withdrawal Issue</option>
                                    <option>Investment / Plan Question</option>
                                    <option>Account Access</option>
                                    <option>Verification</option>
                                    <option>General Inquiry</option>
                                    <option>Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Priority</label>
                                <div class="prio-grid">
                                    <div class="prio-card" onclick="selectPrio(this,'low')">
                                        <div class="prio-icon">🟢</div>
                                        <div class="prio-lbl">Low</div>
                                        <input type="radio" name="priority" value="low" style="display:none;">
                                    </div>
                                    <div class="prio-card active" onclick="selectPrio(this,'medium')">
                                        <div class="prio-icon">🟡</div>
                                        <div class="prio-lbl">Medium</div>
                                        <input type="radio" name="priority" value="medium" checked style="display:none;">
                                    </div>
                                    <div class="prio-card" onclick="selectPrio(this,'high')">
                                        <div class="prio-icon">🔴</div>
                                        <div class="prio-lbl">High</div>
                                        <input type="radio" name="priority" value="high" style="display:none;">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Message</label>
                                <textarea class="form-control-dark" name="message" rows="5"
                                          placeholder="Describe your issue in detail — include transaction IDs, amounts, dates, etc."></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Attachment (Optional)</label>
                                <input type="file" class="form-control-dark" name="attachment"
                                       accept="image/*,.pdf,.txt">
                                <small style="font-size:.76rem;color:var(--text-muted);margin-top:5px;display:block;">
                                    Screenshots, receipts, or relevant documents. Max 5MB.
                                </small>
                            </div>

                            <button type="submit" class="submit-btn">
                                <i class="bi bi-send-fill me-2"></i>Send Ticket
                            </button>
                        </form>
                    </div>

                    <!-- FAQ -->
                    <div class="dash-card fade-in">
                        <div class="card-header">
                            <h3><i class="bi bi-question-circle me-2" style="color:var(--gold);"></i>Frequently Asked Questions</h3>
                        </div>
                        <div id="faqList">
                            <div class="faq-item">
                                <div class="faq-question" onclick="toggleFaq(this)">
                                    How long do deposits take to process?
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                                <div class="faq-answer">
                                    Deposits are typically reviewed and credited within 15–30 minutes after our team verifies your payment proof. During peak hours it may take slightly longer.
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question" onclick="toggleFaq(this)">
                                    How long do withdrawals take?
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                                <div class="faq-answer">
                                    Withdrawal requests are processed within 15–30 minutes. Crypto withdrawals are instant once approved. Bank wire transfers may take 1–3 business days.
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question" onclick="toggleFaq(this)">
                                    What is the minimum investment amount?
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                                <div class="faq-answer">
                                    The minimum investment depends on the plan: Regular Plan starts at $200, Premium at $1,000, Exclusive at $5,000, and VIP at $10,000.
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question" onclick="toggleFaq(this)">
                                    Is my principal returned with my profit?
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                                <div class="faq-answer">
                                    Yes. Every investment plan includes a full principal return. You receive both your original investment amount and the earned profit at the end of the plan duration.
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question" onclick="toggleFaq(this)">
                                    What is the withdrawal processing fee?
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                                <div class="faq-answer">
                                    A 2% processing fee is applied to all withdrawal requests. This is automatically calculated and shown in the withdrawal form before you submit.
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question" onclick="toggleFaq(this)">
                                    How do I refer a friend?
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                                <div class="faq-answer">
                                    You earn a 5% referral commission on every deposit made by investors you refer. Your unique referral link is available in your Profile page.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right: Contact Info + Ticket History -->
                <div style="display:flex;flex-direction:column;gap:24px;">

                    <!-- Contact Info -->
                    <div class="dash-card fade-in">
                        <div class="card-header">
                            <h3><i class="bi bi-telephone me-2" style="color:var(--green);"></i>Contact Us</h3>
                        </div>

                        <div class="contact-card">
                            <div class="contact-icon" style="background:rgba(0,200,150,.12);color:var(--green);">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div>
                                <div class="contact-title">Email Support</div>
                                <a href="mailto:support@anchortrdltd.com" class="contact-val">support@anchortrdltd.com</a>
                                <div class="contact-sub">24/7 — replies within 30 min</div>
                            </div>
                        </div>

                        <div class="contact-card">
                            <div class="contact-icon" style="background:rgba(79,142,247,.12);color:var(--primary);">
                                <i class="bi bi-telegram"></i>
                            </div>
                            <div>
                                <div class="contact-title">Telegram</div>
                                <a href="https://t.me/anchortrdltd" target="_blank" rel="noopener" class="contact-val">@anchortrdltd</a>
                                <div class="contact-sub">Fast response via Telegram</div>
                            </div>
                        </div>

                        <div class="contact-card">
                            <div class="contact-icon" style="background:rgba(37,211,102,.12);color:#25d366;">
                                <i class="bi bi-whatsapp"></i>
                            </div>
                            <div>
                                <div class="contact-title">WhatsApp</div>
                                <a href="https://wa.me/1234567890" target="_blank" rel="noopener" class="contact-val">+1 (234) 567-8900</a>
                                <div class="contact-sub">Chat with a live agent</div>
                            </div>
                        </div>

                        <!-- Hours -->
                        <div style="background:var(--card-alt);border-radius:10px;padding:14px 16px;margin-top:4px;">
                            <div style="font-size:.82rem;font-weight:600;margin-bottom:10px;">
                                <i class="bi bi-clock me-1" style="color:var(--primary);"></i>Support Hours
                            </div>
                            <div style="display:flex;flex-direction:column;gap:6px;">
                                <div style="display:flex;justify-content:space-between;font-size:.8rem;">
                                    <span style="color:var(--text-muted);">Monday – Friday</span>
                                    <span style="font-weight:600;">24 Hours</span>
                                </div>
                                <div style="display:flex;justify-content:space-between;font-size:.8rem;">
                                    <span style="color:var(--text-muted);">Saturday – Sunday</span>
                                    <span style="font-weight:600;">24 Hours</span>
                                </div>
                                <div style="font-size:.75rem;color:var(--green);margin-top:4px;">
                                    <i class="bi bi-circle-fill" style="font-size:.5rem;margin-right:5px;"></i>
                                    Support is online now
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Tickets -->
                    <div class="dash-card fade-in">
                        <div class="card-header">
                            <h3><i class="bi bi-ticket-perforated me-2" style="color:var(--primary);"></i>My Tickets</h3>
                        </div>

                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>No support tickets yet.<br>Submit a ticket above if you need help.</p>
                        </div>

                        <!-- ticket rows will be rendered here once wired to the database -->
                    </div>

                </div>
            </div>

        </main>

<script>
function selectPrio(el, val) {
    document.querySelectorAll('.prio-card').forEach(c => {
        c.classList.remove('active');
        c.querySelector('input[type=radio]').checked = false;
    });
    el.classList.add('active');
    el.querySelector('input[type=radio]').checked = true;
}

function toggleFaq(el) {
    const answer = el.nextElementSibling;
    const isOpen = answer.classList.contains('open');

    // close all
    document.querySelectorAll('.faq-answer').forEach(a => a.classList.remove('open'));
    document.querySelectorAll('.faq-question').forEach(q => q.classList.remove('open'));

    if (!isOpen) {
        answer.classList.add('open');
        el.classList.add('open');
    }
}
</script>

@include('user.footer')
