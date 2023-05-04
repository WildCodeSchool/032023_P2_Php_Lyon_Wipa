const buttons = document.querySelectorAll('button[data-bs-toggle="tab"]');

buttons.forEach(button => {
    button.addEventListener('shown.bs.tab', (event) => {
        const { target } = event;
        const { id: targetId } = target;

        saveButtonId(targetId);
    });
});

const saveButtonId = (selector) => {
    localStorage.setItem('activeButtonId', selector);
};

const getButtonId = () => {
    const activeButtonId = localStorage.getItem('activeButtonId');

    // if local storage item is null, show default tab
    if (!activeButtonId) return;

    // call 'show' function
    const someTabTriggerEl = document.querySelector(`#${activeButtonId}`)
    const tab = new bootstrap.Tab(someTabTriggerEl);

    tab.show();
};

// get pill id on load
getButtonId();