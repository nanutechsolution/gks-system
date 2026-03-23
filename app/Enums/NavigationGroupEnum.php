<?php

namespace App\Enums;

/**
 * Enum untuk mengelola nama grup navigasi di Panel Admin.
 * Gunakan enum ini di AdminPanelProvider dan setiap Resource.
 */
enum NavigationGroupEnum: string
{
    case DataMaster = 'Data Master';
    case Publikasi = 'Publikasi';
    case Pelayanan = 'Pelayanan';
    case Administrasi = 'Administrasi';
    case AksesKontrol = 'Akses Kontrol';
}
