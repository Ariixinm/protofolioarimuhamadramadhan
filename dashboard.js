// ===============================
// Dashboard Admin JS
// ===============================

// Toggle Sidebar
const menuToggle = document.querySelector(".menu-toggle");
const sidebar = document.querySelector(".sidebar");
const main = document.querySelector(".main");

menuToggle.addEventListener("click", function () {
  if (window.innerWidth > 768) {
    sidebar.classList.toggle("close");
    main.classList.toggle("full");
  } else {
    sidebar.classList.toggle("show");
  }
});

// Menandai menu aktif
const menuItems = document.querySelectorAll(".sidebar ul li");

menuItems.forEach((item) => {
  item.addEventListener("click", function () {
    menuItems.forEach((li) => li.classList.remove("active"));

    this.classList.add("active");
  });
});

// Menampilkan tanggal dan waktu
function updateClock() {
  const now = new Date();

  const hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

  const bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

  let jam = String(now.getHours()).padStart(2, "0");
  let menit = String(now.getMinutes()).padStart(2, "0");
  let detik = String(now.getSeconds()).padStart(2, "0");

  let tanggal = hari[now.getDay()] + ", " + now.getDate() + " " + bulan[now.getMonth()] + " " + now.getFullYear();

  const el = document.getElementById("clock");

  if (el) {
    el.innerHTML = tanggal + " | " + jam + ":" + menit + ":" + detik;
  }
}

setInterval(updateClock, 1000);

updateClock();

// Efek hover card
const cards = document.querySelectorAll(".card");

cards.forEach((card) => {
  card.addEventListener("mouseenter", () => {
    card.style.transform = "translateY(-5px)";
  });

  card.addEventListener("mouseleave", () => {
    card.style.transform = "translateY(0px)";
  });
});

// Tombol kembali ke atas
const topButton = document.createElement("button");

topButton.innerHTML = "↑";

topButton.id = "topBtn";

document.body.appendChild(topButton);

window.addEventListener("scroll", () => {
  if (document.documentElement.scrollTop > 200) {
    topButton.style.display = "block";
  } else {
    topButton.style.display = "none";
  }
});

topButton.addEventListener("click", () => {
  window.scrollTo({
    top: 0,

    behavior: "smooth",
  });
});

// ======================
// Jam
// ======================
function updateClock() {
  const now = new Date();

  const clock = document.getElementById("clock");

  if (clock) {
    clock.innerHTML = now.toLocaleString("id-ID");
  }
}

setInterval(updateClock, 1000);
updateClock();

// ======================
// GRAFIK PENJUALAN
// ======================

const ctx = document.getElementById("salesChart");

if (ctx) {
  new Chart(ctx, {
    type: "bar",

    data: {
      labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul"],

      datasets: [
        {
          label: "Penjualan",

          data: [120, 190, 300, 250, 400, 350, 500],

          backgroundColor: ["#2563EB", "#10B981", "#F59E0B", "#EF4444", "#8B5CF6", "#06B6D4", "#1E40AF"],

          borderRadius: 8,
        },
      ],
    },

    options: {
      responsive: true,

      plugins: {
        legend: {
          display: false,
        },
      },

      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
}
