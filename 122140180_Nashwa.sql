CREATE DATABASE IF NOT EXISTS mahasiswa_db;

USE mahasiswa_db;

CREATE TABLE IF NOT EXISTS mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    jurusan VARCHAR(50) NOT NULL,
    angkatan YEAR NOT NULL
);

INSERT INTO mahasiswa (nama, jurusan, angkatan) VALUES
('Aulia', 'Informatika', 2020),
('Bima', 'Sistem Informasi', 2021),
('Citra', 'Teknik Elektro', 2019),
('Damar', 'Informatika', 2022),
('Eka', 'Sistem Informasi', 2020),
('Farah', 'Teknik Elektro', 2019),
('Galih', 'Informatika', 2021),
('Hana', 'Sistem Informasi', 2022),
('Iqbal', 'Teknik Elektro', 2020),
('Jasmine', 'Informatika', 2021),
('Kirana', 'Sistem Informasi', 2019),
('Lutfi', 'Teknik Elektro', 2022);