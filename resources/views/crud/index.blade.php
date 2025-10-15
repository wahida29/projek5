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
    .modal-header { background:#3e2723; color:white; }
  </style>
</head>
<body>
  <div class="container my-5">
    <h1 class="text-center mb-4"><i class="bi bi-database-gear"></i> Dashboard CRUD API</h1>

    <ul class="nav nav-tabs justify-content-center">
      <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#k1">SobatPromo</a></li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k2">JustBuy</a></li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k3">Gadget House</a></li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k4">Krusit</a></li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k5">CoffeeShop</a></li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k6">Reservasi</a></li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k7">Maguru</a></li>
    </ul>

    <div class="tab-content mt-4">
      <div class="tab-pane fade show active" id="k1"><h4>SobatPromo 🎟️</h4><div id="dataSobatPromo" class="spinner">Memuat data...</div></div>
      <div class="tab-pane fade" id="k2"><h4>JustBuy 🛒</h4><div id="dataJustBuy" class="spinner">Memuat data...</div></div>
      <div class="tab-pane fade" id="k3"><h4>Gadget House 🔧</h4><div id="dataGadget" class="spinner">Memuat data...</div></div>
      <div class="tab-pane fade" id="k4"><h4>Krusit 🍱</h4><div id="dataKrusit" class="spinner">Memuat data...</div></div>
      <div class="tab-pane fade" id="k5"><h4>CoffeeShop ☕</h4><div id="dataCoffee" class="spinner">Memuat data...</div></div>
      <div class="tab-pane fade" id="k6"><h4>Reservasi 🏨</h4><div id="dataReservasi" class="spinner">Memuat data...</div></div>
      <div class="tab-pane fade" id="k7"><h4>Maguru 📚</h4><div id="dataMaguru" class="spinner">Memuat data...</div></div>
    </div>
  </div>

  <!-- Modal Edit -->
  <div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Edit Data</h5></div>
        <div class="modal-body">
          <form id="editForm">
            <input type="hidden" id="editId">
            <div class="mb-3"><label>Nama</label><input type="text" id="editNama" class="form-control" required></div>
            <div class="mb-3"><label>Deskripsi</label><input type="text" id="editDeskripsi" class="form-control"></div>
            <div class="mb-3"><label>Harga</label><input type="number" id="editHarga" class="form-control"></div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-brown" id="saveEdit">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <script>
  const API = {
    SOBAT: "https://sobatpromo-api-production.up.railway.app/api.php",
    JUSTBUY: "https://projekkelompok9-production.up.railway.app/api",
    KRUSIT: "https://projekkelompok4-production-3d9b.up.railway.app/api",
    COFFEE: "https://projek5-production.up.railway.app/api",
    MAGURU: "http://localhost:3001/api/public"
  };

  async function getData(url, container) {
    try {
      const res = await fetch(url);
      if (!res.ok) throw new Error("Gagal fetch");
      const data = await res.json();
      if (!Array.isArray(data)) throw new Error("Format tidak sesuai");
      document.getElementById(container).innerHTML = buildTable(data, url);
    } catch {
      document.getElementById(container).innerHTML = "<p class='text-danger'>Server tidak aktif.</p>";
    }
  }

  function buildTable(data, url) {
    let rows = data.map(d => `
      <tr>
        <td>${d.id || d.id_menu || '-'}</td>
        <td>${d.name || d.nama || d.title || '-'}</td>
        <td>${d.description || d.deskripsi || d.desc || '-'}</td>
        <td>${d.price || d.harga || '-'}</td>
        <td>
          <button class='btn btn-warning btn-sm' onclick="openEditModal('${url}', ${d.id || d.id_menu || 0}, '${d.name || d.nama || ''}', '${d.description || d.deskripsi || ''}', '${d.price || d.harga || 0}')"><i class='bi bi-pencil-square'></i></button>
          <button class='btn btn-danger btn-sm' onclick="deleteItem('${url}', ${d.id || d.id_menu || 0})"><i class='bi bi-trash3'></i></button>
        </td>
      </tr>`).join('');
    return `<table class='table table-bordered text-center'><thead><tr><th>ID</th><th>Nama</th><th>Deskripsi</th><th>Harga</th><th>Aksi</th></tr></thead><tbody>${rows}</tbody></table>`;
  }

  function openEditModal(url, id, nama, deskripsi, harga) {
    document.getElementById("editId").value = id;
    document.getElementById("editNama").value = nama;
    document.getElementById("editDeskripsi").value = deskripsi;
    document.getElementById("editHarga").value = harga;
    document.getElementById("saveEdit").onclick = () => saveEdit(url);
    new bootstrap.Modal(document.getElementById("editModal")).show();
  }

  async function saveEdit(url) {
    const id = document.getElementById("editId").value;
    const body = {
      name: document.getElementById("editNama").value,
      description: document.getElementById("editDeskripsi").value,
      price: Number(document.getElementById("editHarga").value),
      _method: "PUT"
    };
    try {
      await fetch(`${url}/${id}`, {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(body)
      });
      alert("✅ Data berhasil diperbarui!");
      location.reload();
    } catch {
      alert("❌ Gagal menghubungi server.");
    }
  }

  async function deleteItem(url, id) {
    if (!confirm("Yakin ingin hapus data ini?")) return;
    try {
      await fetch(`${url}/${id}`, { method: "DELETE" });
      alert("🗑️ Data dihapus!");
      location.reload();
    } catch {
      alert("⚠️ Gagal menghapus data!");
    }
  }

  // panggil data awal
  getData(`${API.SOBAT}?action=list`, "dataSobatPromo");
  getData(`${API.JUSTBUY}/list`, "dataJustBuy");
  getData(`${API.KRUSIT}/makanan`, "dataKrusit");
  getData(`${API.COFFEE}/kopi`, "dataCoffee");
  getData(`${API.MAGURU}/products`, "dataMaguru");
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
