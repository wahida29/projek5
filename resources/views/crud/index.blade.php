<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>☕ Dashboard CRUD API</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background-color:#f8f9fa; font-family:"Poppins",sans-serif; }
    h1 { font-weight:700; color:#3e2723; }
    .nav-tabs .nav-link.active { background-color:#3e2723; color:white !important; border:none; }
    .nav-tabs .nav-link:hover { color:#3e2723; }
    .card { border-radius:12px; box-shadow:0 2px 6px rgba(0,0,0,0.1); }
    .table th { background:#3e2723; color:#fff; }
    .btn-brown { background:#6f4e37; color:#fff; border:none; }
    .btn-brown:hover { background:#5c4033; }
    .spinner { text-align:center; padding:20px; color:#666; }
  </style>
</head>
<body>
  <div class="container my-5">
    <h1 class="text-center mb-4"><i class="bi bi-database-gear"></i> Dashboard CRUD API</h1>

    <!-- Tabs -->
    <ul class="nav nav-tabs justify-content-center" id="kelompokTabs">
      <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#k1">SobatPromo</a></li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k2">JustBuy</a></li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k3">Gadget House</a></li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k4">Krusit</a></li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k5">CoffeeShop</a></li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k6">Reservasi</a></li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k7">Maguru</a></li>
    </ul>

    <!-- Konten -->
    <div class="tab-content mt-4">

      <!-- KELOMPOK 1 -->
      <div class="tab-pane fade show active" id="k1">
        <h4>SobatPromo 🎟️</h4>
        <div id="dataSobatPromo" class="spinner">Memuat data...</div>
      </div>

      <!-- KELOMPOK 2 -->
      <div class="tab-pane fade" id="k2">
        <h4>JustBuy 🛒</h4>
        <div id="dataJustBuy" class="spinner">Memuat data...</div>
      </div>

      <!-- KELOMPOK 3 -->
      <div class="tab-pane fade" id="k3">
        <h4>Gadget House 🔧</h4>
        <div id="dataGadget" class="spinner">Belum ada endpoint aktif.</div>
      </div>

      <!-- KELOMPOK 4 -->
      <div class="tab-pane fade" id="k4">
        <h4>Krusit 🍱</h4>
        <div id="dataKrusit" class="spinner">Memuat data makanan & minuman...</div>
      </div>

      <!-- KELOMPOK 5 -->
      <div class="tab-pane fade" id="k5">
        <h4>CoffeeShop ☕</h4>

        <!-- Form -->
        <div class="card mb-3">
          <div class="card-header bg-brown text-white">Tambah Menu</div>
          <div class="card-body">
            <form id="formAddCoffee" class="row g-2">
              <div class="col-md-3"><input type="text" id="coffeeName" class="form-control" placeholder="Nama Menu" required></div>
              <div class="col-md-3"><input type="text" id="coffeeDesc" class="form-control" placeholder="Deskripsi" required></div>
              <div class="col-md-2">
                <select id="coffeeCat" class="form-select" required>
                  <option value="">Kategori</option>
                  <option value="kopi">Kopi</option>
                  <option value="nonkopi">NonKopi</option>
                </select>
              </div>
              <div class="col-md-2"><input type="number" id="coffeePrice" class="form-control" placeholder="Harga" required></div>
              <div class="col-md-2"><button type="submit" class="btn btn-success w-100"><i class="bi bi-plus-circle"></i> Tambah</button></div>
            </form>
          </div>
        </div>

        <!-- Tabel -->
        <div class="card">
          <div class="card-header bg-brown text-white d-flex justify-content-between">
            <span>Daftar Menu</span>
            <button id="btnReloadCoffee" class="btn btn-light btn-sm"><i class="bi bi-arrow-clockwise"></i> Reload</button>
          </div>
          <div class="card-body">
            <table class="table table-bordered align-middle text-center">
              <thead><tr><th>ID</th><th>Nama</th><th>Deskripsi</th><th>Kategori</th><th>Harga</th><th>Aksi</th></tr></thead>
              <tbody id="coffeeTable"><tr><td colspan="6">Memuat...</td></tr></tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- KELOMPOK 6 -->
      <div class="tab-pane fade" id="k6">
        <h4>Reservasi 🏨</h4>
        <div id="dataReservasi" class="spinner">Endpoint belum aktif.</div>
      </div>

      <!-- KELOMPOK 7 -->
      <div class="tab-pane fade" id="k7">
        <h4>Maguru 📚</h4>
        <div id="dataMaguru" class="spinner">Server Maguru tidak aktif (localhost).</div>
      </div>
    </div>
  </div>

  <script>
    // === SOBATPROMO ===
    fetch("https://sobatpromo-api-production.up.railway.app/api.php?action=list")
      .then(r=>r.json())
      .then(d=>{
        const wrap=document.getElementById("dataSobatPromo");
        wrap.innerHTML = Array.isArray(d) && d.length ?
          `<table class='table table-bordered text-center'>
            <thead><tr><th>Judul</th><th>Deskripsi</th><th>Berlaku Sampai</th></tr></thead>
            <tbody>${d.map(p=>`<tr><td>${p.title}</td><td>${p.description}</td><td>${p.valid_until}</td></tr>`).join('')}</tbody>
          </table>` : "Tidak ada data promo.";
      }).catch(()=>document.getElementById("dataSobatPromo").innerHTML="Gagal memuat data promo.");

    // === JUSTBUY ===
    fetch("https://projekkelompok9-production.up.railway.app/api/delete_ML.php")
      .then(r=>r.text()).then(t=>{
        document.getElementById("dataJustBuy").innerHTML=`<pre>${t}</pre>`;
      }).catch(()=>document.getElementById("dataJustBuy").innerHTML="API tidak merespons.");

    // === KRUSIT ===
    async function loadKrusit(){
      const makanan=await fetch("https://projekkelompok4-production-3d9b.up.railway.app/api/makanan").then(r=>r.json()).catch(()=>[]);
      const minuman=await fetch("https://projekkelompok4-production-3d9b.up.railway.app/api/minuman").then(r=>r.json()).catch(()=>[]);
      document.getElementById("dataKrusit").innerHTML=
        `<h6>Makanan</h6><pre>${JSON.stringify(makanan,null,2)}</pre><h6>Minuman</h6><pre>${JSON.stringify(minuman,null,2)}</pre>`;
    } loadKrusit();

    // === COFFEESHOP ===
    const API="https://projek5-production.up.railway.app/api";
    async function loadCoffee(){
      const kopi=await fetch(`${API}/kopi`).then(r=>r.json()).catch(()=>[]);
      const nonkopi=await fetch(`${API}/nonkopi`).then(r=>r.json()).catch(()=>[]);
      const all=[...kopi,...nonkopi];
      const table=document.getElementById("coffeeTable");
      if(!all.length)return table.innerHTML="<tr><td colspan='6'>Tidak ada data</td></tr>";
      table.innerHTML=all.map(i=>`
        <tr>
          <td>${i.id}</td><td>${i.name}</td><td>${i.description}</td><td>${i.category}</td><td>Rp${i.price}</td>
          <td>
            <button class='btn btn-warning btn-sm' onclick="editCoffee(${i.id},'${i.category}')"><i class='bi bi-pencil-square'></i></button>
            <button class='btn btn-danger btn-sm' onclick="delCoffee(${i.id},'${i.category}')"><i class='bi bi-trash3'></i></button>
          </td>
        </tr>`).join('');
    }
    document.getElementById("formAddCoffee").addEventListener("submit",async e=>{
      e.preventDefault();
      const data={name:coffeeName.value,description:coffeeDesc.value,category:coffeeCat.value,price:Number(coffeePrice.value)};
      await fetch(`${API}/${data.category}`,{method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify(data)});
      e.target.reset(); loadCoffee();
    });
    async function editCoffee(id,cat){
      const newName=prompt("Nama baru:");
      if(!newName)return;
      await fetch(`${API}/${cat}/${id}`,{method:"PUT",headers:{"Content-Type":"application/json"},body:JSON.stringify({name:newName})});
      loadCoffee();
    }
    async function delCoffee(id,cat){
      if(!confirm("Hapus menu ini?"))return;
      await fetch(`${API}/${cat}/${id}`,{method:"DELETE"});
      loadCoffee();
    }
    document.getElementById("btnReloadCoffee").addEventListener("click",loadCoffee);
    loadCoffee();
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
