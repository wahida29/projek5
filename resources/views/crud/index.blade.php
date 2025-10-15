<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>🌐 Dashboard Kolaborasi CRUD 7 Kelompok</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body { background:#f8f9fa; font-family: system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial; }
    h1 { font-weight:700; color:#222; }
    .tab-pane { animation: fadeIn .3s ease-in-out; }
    @keyframes fadeIn { from{opacity:0} to{opacity:1} }
    .spinner { text-align:center; padding:30px; color:#666; font-style:italic; }
    .badge { font-weight:500; }
  </style>
</head>
<body>
  <div class="container my-4">
    <h1 class="text-center mb-4">🌐 Dashboard Kolaborasi CRUD 7 Kelompok</h1>

    <ul class="nav nav-tabs" id="crudTabs">
      <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#k1">Kelompok 1 – SobatPromo</a></li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k2">Kelompok 2 – JustBuy</a></li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k4">Kelompok 4 – Krusit</a></li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k5">Kelompok 5 – CoffeeShop</a></li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k6">Kelompok 6 – Reservasi</a></li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k7">Kelompok 7 – Maguru</a></li>
    </ul>

    <div class="tab-content mt-3">
      <!-- Kelompok 1 -->
      <div class="tab-pane fade show active" id="k1">
        <h4 class="mb-3">Kelompok 1: SobatPromo</h4>
        <div id="dataSobatPromo" class="spinner">Memuat data promo...</div>
      </div>

      <!-- Kelompok 2 -->
      <div class="tab-pane fade" id="k2">
        <h4 class="mb-3">Kelompok 2: JustBuy</h4>
        <div id="dataJustBuy" class="spinner">Memuat data akun...</div>
      </div>

      <!-- Kelompok 4 -->
      <div class="tab-pane fade" id="k4">
        <h4 class="mb-3">Kelompok 4: Krusit</h4>
        <div id="dataKrusit" class="spinner">Memuat menu makanan & minuman...</div>
      </div>

      <!-- Kelompok 5 -->
      <div class="tab-pane fade" id="k5">
        <h4 class="mb-3">Kelompok 5: CoffeeShop</h4>
        <div id="dataCoffee" class="spinner">Memuat data kopi & nonkopi...</div>
      </div>

      <!-- Kelompok 6 -->
      <div class="tab-pane fade" id="k6">
        <h4 class="mb-3">Kelompok 6: Reservasi</h4>
        <div id="dataReservasi" class="spinner">Memuat reservasi...</div>
      </div>

      <!-- Kelompok 7 -->
      <div class="tab-pane fade" id="k7">
        <h4 class="mb-3">Kelompok 7: Maguru</h4>
        <div id="dataMaguru" class="spinner">Memuat produk & kategori...</div>
      </div>
    </div>
  </div>

  <script>
    // === Kelompok 1: SobatPromo ===
    fetch("https://sobatpromo-api-production.up.railway.app/api.php?action=list")
      .then(r=>r.json()).then(d=>{
        const wrap=document.getElementById("dataSobatPromo");
        wrap.innerHTML = Array.isArray(d) && d.length ?
          `<table class="table table-bordered"><thead><tr><th>Judul</th><th>Deskripsi</th><th>Berlaku Sampai</th></tr></thead><tbody>
            ${d.map(p=>`<tr><td>${p.title}</td><td>${p.description}</td><td>${p.valid_until}</td></tr>`).join("")}
          </tbody></table>` : "Tidak ada data promo.";
      }).catch(()=>document.getElementById("dataSobatPromo").textContent="Gagal memuat data promo.");

    // === Kelompok 2: JustBuy === (contoh sederhana)
    fetch("https://projekkelompok9-production.up.railway.app/api/delete_ML.php")
      .then(r=>r.text()).then(t=>{
        document.getElementById("dataJustBuy").innerHTML=`<pre>${t}</pre>`;
      }).catch(()=>document.getElementById("dataJustBuy").textContent="API tidak merespon.");

    // === Kelompok 4: Krusit ===
    async function loadKrusit() {
      const makanan = await fetch("https://projekkelompok4-production-3d9b.up.railway.app/api/makanan").then(r=>r.json()).catch(()=>[]);
      const minuman = await fetch("https://projekkelompok4-production-3d9b.up.railway.app/api/minuman").then(r=>r.json()).catch(()=>[]);
      document.getElementById("dataKrusit").innerHTML =
        `<h6>Makanan</h6><pre>${JSON.stringify(makanan,null,2)}</pre>
         <h6>Minuman</h6><pre>${JSON.stringify(minuman,null,2)}</pre>`;
    }
    loadKrusit();

    // === Kelompok 5: CoffeeShop ===
    async function loadCoffee() {
      const kopi = await fetch("https://projek5-production.up.railway.app/api/kopi").then(r=>r.json()).catch(()=>[]);
      const nonkopi = await fetch("https://projek5-production.up.railway.app/api/nonkopi").then(r=>r.json()).catch(()=>[]);
      document.getElementById("dataCoffee").innerHTML =
        `<h6>Kopi</h6><pre>${JSON.stringify(kopi,null,2)}</pre>
         <h6>NonKopi</h6><pre>${JSON.stringify(nonkopi,null,2)}</pre>`;
    }
    loadCoffee();

    // === Kelompok 6: Reservasi ===
    document.getElementById("dataReservasi").innerHTML = "Endpoint belum aktif di Postman.";

    // === Kelompok 7: Maguru ===
    fetch("http://localhost:3001/api/public/products")
      .then(r=>r.json()).then(d=>{
        document.getElementById("dataMaguru").innerHTML =
          `<pre>${JSON.stringify(d,null,2)}</pre>`;
      }).catch(()=>document.getElementById("dataMaguru").textContent="Server Maguru tidak aktif (localhost).");
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
