const form = document.getElementById("helmetForm");
const table = document.getElementById("helmetTable");

function loadHelmets() {
    fetch("../api/helmets/get_helmets.php")
        .then(res => res.json())
        .then(data => {
            table.innerHTML = "";
            data.data.forEach(h => {
                table.innerHTML += `
                    <tr>
                        <td>${h.helmet_uid}</td>
                        <td>${h.owner_name}</td>
                        <td>${h.phone_number}</td>
                        <td>${h.created_at}</td>
                    </tr>
                `;
            });
        });
}

form.addEventListener("submit", e => {
    e.preventDefault();

    const payload = {
        helmet_uid: document.getElementById("helmet_uid").value,
        owner_name: document.getElementById("owner_name").value,
        phone_number: document.getElementById("phone_number").value
    };

    fetch("../api/helmets/register.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if (data.status) {
            form.reset();
            loadHelmets();
        }
    });
});

loadHelmets();
