@extends('layouts.app')

@section('content')
<div class="about-container">
   <div class="header mb-5 text-center">
    <h1 class="display-4 fw-bold text-gradient">Tentang Saya</h1>
    <div class="header-divider"></div>
  
</div>



    <div class="card profile-card shadow-lg">
        <div class="card-body p-4 text-center">
            {{-- Foto Profil dengan efek hover --}}
            <div class="profile-image-container mb-4">
                <img src="{{ asset('asset/images/foto_renop.jpg') }}" 
                     alt="Achmad Savero Windi Pradana" 
                     class="profile-image">
                <div class="image-overlay"></div>
            </div>

            {{-- Informasi Profil --}}
            <h2 class="mb-2 fw-bold">Achmad Savero Windi Pradana</h2>
            <div class="info-item mb-2">
                <i class="fas fa-id-card me-2"></i>
                <span>NIM: 2141762135</span>
            </div>
            <div class="info-item mb-3">
                <i class="fas fa-calendar-alt me-2"></i>
                <span>Tanggal Pembuatan: 4 September 2025</span>
            </div>
            
            {{-- Social Media Icons --}}
            <div class="social-links mt-4">
                <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>
</div>

<style>
    .about-container {
        padding: 2rem 0;
        min-height: 80vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }
    
    .text-gradient {
        background: linear-gradient(45deg, #4e73df, #224abe);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .header-divider {
        height: 4px;
        width: 80px;
        background: linear-gradient(to right, #4e73df, #224abe);
        margin: 1rem auto;
        border-radius: 2px;
    }
    
    .profile-card {
        max-width: 450px;
        margin: 0 auto;
        border: none;
        border-radius: 1rem;
        overflow: hidden;
        background: #ffffff;
        transition: transform 0.3s ease;
    }
    
    .profile-card:hover {
        transform: translateY(-5px);
    }
    
    .profile-image-container {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 0 auto;
    }
    
    .profile-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #f8f9fc;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 2;
    }
    
    .image-overlay {
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        background: linear-gradient(45deg, #4e73df, #224abe);
        border-radius: 50%;
        z-index: 1;
    }
    
    .info-item {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #5a5c69;
    }
    
    .social-links {
        display: flex;
        justify-content: center;
        gap: 15px;
    }
    
    .social-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #f8f9fc;
        color: #4e73df;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .social-link:hover {
        background: #4e73df;
        color: #fff;
        transform: translateY(-3px);
    }
    
    @media (max-width: 576px) {
        .profile-card {
            margin: 0 15px;
        }
        
        .header h1 {
            font-size: 2rem;
        }
    }
    .about-text {
    max-width: 600px;
    margin: 0 auto;
    font-size: 1rem;
    color: #4b5563; /* abu-abu elegan */
    line-height: 1.6;
}

</style>
@endsection