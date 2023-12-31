// Membuat daftar urutan kedatangan tamu
const urutanKedatangan = ["Ningguang", "Hutao", "Xiao", "Childe"];

// Membuat objek untuk melacak kebiasaan tamu
const kebiasaanTamu = {
  Ningguang: "memeriksa kue",
  Hutao: "memberikan kado",
  Xiao: "memotret",
  Childe: "meletakkan air mineral",
};

// Memeriksa foto yang diambil oleh Xiao
const fotoXiaoMenunjukkanKue = true;

// Memeriksa urutan tamu yang paling mungkin mengambil kue
let tamuYangPalingMungkinMengambilKue = null;

for (let i = 0; i < urutanKedatangan.length; i++) {
  const tamu = urutanKedatangan[i];

  // Jika Xiao adalah tamu yang memotret kue pertama kali dan foto menunjukkan kue masih utuh
  if (tamu === "Xiao" && fotoXiaoMenunjukkanKue) {
    continue; // Skip Xiao karena foto menunjukkan kue masih utuh saat dia masuk
  }

  // Jika tamu memiliki kebiasaan "memeriksa kue" atau "meletakkan air mineral"
  if (kebiasaanTamu[tamu] === "memeriksa kue" || kebiasaanTamu[tamu] === "meletakkan air mineral") {
    tamuYangPalingMungkinMengambilKue = tamu;
    break; // Kita telah menemukan tamu yang paling mungkin mengambil kue
  }
}

// Menampilkan hasil
if (tamuYangPalingMungkinMengambilKue) {
  console.log(`${tamuYangPalingMungkinMengambilKue} adalah yang paling mungkin mengambil kue.`);
} else {
  console.log("Tidak ada informasi yang cukup untuk menentukan siapa yang mengambil kue.");
}
