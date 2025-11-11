const formToJson = (formElement) => {
    const formData = new FormData(formElement);
    const data = {};
    formData.forEach((value, key) => {
        data[key] = value;
    });
    return data;
};

const closeLeadModal = () => {
    const leadModal = document.querySelector('#lead-modal');
    if (!leadModal) return;
    leadModal.classList.remove('is-visible');
    leadModal.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('modal-open');
};

const attachLeadForm = (form) => {
    const feedback = form.querySelector('.form-feedback');
    const submitBtn = form.querySelector('button[type="submit"]');
    const privacyField = form.querySelector('input[name="privacy"]');

    const setFeedback = (message, type = 'info') => {
        if (!feedback) return;
        feedback.textContent = message;
        feedback.classList.remove('form-feedback--success', 'form-feedback--error');
        const modifier = type === 'success' ? 'form-feedback--success' : type === 'error' ? 'form-feedback--error' : null;
        if (modifier) {
            feedback.classList.add(modifier);
        }
    };

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        if (!form.reportValidity()) return;

        if (privacyField && !privacyField.checked) {
            setFeedback('Per procedere è necessario accettare la privacy.', 'error');
            return;
        }

        try {
            submitBtn?.classList.add('btn--loading');
            submitBtn?.setAttribute('disabled', 'disabled');
            setFeedback('Invio in corso...');

            const response = await fetch('/api/subscriptions', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(formToJson(form)),
            });

            const payload = await response.json();

            if (!response.ok) {
                const firstError = payload?.errors && Object.values(payload.errors)[0]?.[0];
                throw new Error(firstError || payload?.message || 'Si è verificato un problema, riprova.');
            }

            setFeedback(payload.message || 'Richiesta inviata con successo.', 'success');
            form.reset();

            if (form.closest('.lead-modal')) {
                setTimeout(() => closeLeadModal(), 1000);
            }
        } catch (error) {
            setFeedback(error.message, 'error');
        } finally {
            submitBtn?.classList.remove('btn--loading');
            submitBtn?.removeAttribute('disabled');
        }
    });
};

document.querySelectorAll('[data-lead-form]').forEach((form) => attachLeadForm(form));

// Modal logic
const leadModal = document.querySelector('#lead-modal');
const openModalButtons = document.querySelectorAll('.js-open-lead-modal');
const modalCloseTriggers = document.querySelectorAll('[data-modal-close]');

const openLeadModal = () => {
    if (!leadModal) return;
    leadModal.classList.add('is-visible');
    leadModal.setAttribute('aria-hidden', 'false');
    document.body.classList.add('modal-open');
    const firstInput = leadModal.querySelector('input, textarea, select');
    setTimeout(() => firstInput?.focus(), 100);
};

openModalButtons.forEach((btn) => btn.addEventListener('click', openLeadModal));
modalCloseTriggers.forEach((trigger) =>
    trigger.addEventListener('click', () => {
        closeLeadModal();
    })
);

leadModal?.addEventListener('click', (event) => {
    if (event.target.classList.contains('lead-modal__overlay')) {
        closeLeadModal();
    }
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && leadModal?.classList.contains('is-visible')) {
        closeLeadModal();
    }
});

// Micro animazione quando gli elementi entrano in viewport
const animatedBlocks = document.querySelectorAll('.bundle-card, .store, .lead, .faq__item');

const observer = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    },
    { threshold: 0.2 }
);

animatedBlocks.forEach((block) => observer.observe(block));
