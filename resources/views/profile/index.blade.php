@extends(auth()->check() && auth()->user()->role === 'user' ? 'layouts.user' : 'layouts.app')

@section('title', 'Profil Saya')

@push('styles')
<style>
/* Dark mode transitions */
* {
    transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
}

/* ===== IMPROVED ENTRANCE ANIMATIONS ===== */

/* Smooth Fade In with Scale */
@keyframes smoothFadeIn {
    0% { 
        opacity: 0; 
        transform: scale(0.95) translateY(20px);
        filter: blur(10px);
    }
    100% { 
        opacity: 1; 
        transform: scale(1) translateY(0);
        filter: blur(0);
    }
}

/* Elegant Slide from Bottom */
@keyframes elegantSlideUp {
    0% { 
        opacity: 0; 
        transform: translateY(40px);
    }
    60% {
        opacity: 0.8;
        transform: translateY(-5px);
    }
    100% { 
        opacity: 1; 
        transform: translateY(0);
    }
}

/* Smooth Slide from Right */
@keyframes smoothSlideRight {
    0% { 
        opacity: 0; 
        transform: translateX(50px);
    }
    100% { 
        opacity: 1; 
        transform: translateX(0);
    }
}

/* Gentle Scale with Fade */
@keyframes gentleScale {
    0% { 
        opacity: 0; 
        transform: scale(0.9);
    }
    50% {
        opacity: 0.5;
    }
    100% { 
        opacity: 1; 
        transform: scale(1);
    }
}

/* Professional Reveal Animation */
@keyframes professionalReveal {
    0% { 
        opacity: 0; 
        transform: translateY(30px);
        clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
    }
    100% { 
        opacity: 1; 
        transform: translateY(0);
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
    }
}

/* Shimmer Animation */
@keyframes shimmer {
    0% { background-position: -1000px 0; }
    100% { background-position: 1000px 0; }
}

/* Float Animation */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
}

/* Pulse Glow Animation */
@keyframes pulse-glow {
    0%, 100% { box-shadow: 0 0 20px rgba(14, 165, 233, 0.4), 0 0 40px rgba(14, 165, 233, 0.2); }
    50% { box-shadow: 0 0 30px rgba(14, 165, 233, 0.6), 0 0 60px rgba(14, 165, 233, 0.3); }
}

.dark .pulse-glow {
    animation: pulse-glow-dark 2s ease-in-out infinite;
}

@keyframes pulse-glow-dark {
    0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.5), 0 0 40px rgba(59, 130, 246, 0.3); }
    50% { box-shadow: 0 0 30px rgba(59, 130, 246, 0.7), 0 0 60px rgba(59, 130, 246, 0.4); }
}

/* Stagger Animation Classes */
.animate-smooth-fade {
    animation: smoothFadeIn 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    opacity: 0;
}

.animate-elegant-slide {
    animation: elegantSlideUp 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    opacity: 0;
}

.animate-gentle-scale {
    animation: gentleScale 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    opacity: 0;
}

.animate-professional-reveal {
    animation: professionalReveal 0.9s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    opacity: 0;
}

.animate-smooth-slide-right {
    animation: smoothSlideRight 0.7s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    opacity: 0;
}

/* Staggered Delay System */
.delay-100 { animation-delay: 0.1s; }
.delay-200 { animation-delay: 0.2s; }
.delay-300 { animation-delay: 0.3s; }
.delay-400 { animation-delay: 0.4s; }
.delay-500 { animation-delay: 0.5s; }
.delay-600 { animation-delay: 0.6s; }

/* Avatar Entrance Animation */
@keyframes avatarEntrance {
    0% {
        opacity: 0;
        transform: scale(0.5) rotate(-10deg);
    }
    60% {
        transform: scale(1.05) rotate(2deg);
    }
    100% {
        opacity: 1;
        transform: scale(1) rotate(0deg);
    }
}

.avatar-container {
    position: relative;
    display: inline-block;
    animation: avatarEntrance 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    opacity: 0;
    animation-delay: 0.2s;
}

/* Info Item Sequential Animation */
@keyframes infoItemReveal {
    0% {
        opacity: 0;
        transform: translateX(-20px);
    }
    100% {
        opacity: 1;
        transform: translateX(0);
    }
}

.info-item {
    display: grid;
    grid-template-columns: 180px 1fr;
    gap: 24px;
    padding: 24px;
    border-radius: 16px;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    position: relative;
    animation: infoItemReveal 0.5s ease-out forwards;
    opacity: 0;
}

.info-item:nth-child(1) { animation-delay: 0.1s; }
.info-item:nth-child(2) { animation-delay: 0.2s; }
.info-item:nth-child(3) { animation-delay: 0.3s; }
.info-item:nth-child(4) { animation-delay: 0.4s; }
.info-item:nth-child(5) { animation-delay: 0.5s; }

/* Activity Timeline Stagger */
@keyframes activityReveal {
    0% {
        opacity: 0;
        transform: translateY(20px) translateX(-10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0) translateX(0);
    }
}

.activity-item {
    background: white;
    border-radius: 20px;
    padding: 24px;
    margin-bottom: 20px;
    border: 2px solid #F1F5F9;
    transition: all 0.3s ease;
    position: relative;
    animation: activityReveal 0.6s ease-out forwards;
    opacity: 0;
}

.dark .activity-item {
    background: #1F2937;
    border-color: #374151;
}

/* Badge Animation */
@keyframes badgeEntrance {
    0% {
        opacity: 0;
        transform: scale(0.8) translateY(10px);
    }
    50% {
        transform: scale(1.05) translateY(-2px);
    }
    100% {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

.role-badge {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 24px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 14px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    position: relative;
    overflow: hidden;
    animation: badgeEntrance 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    opacity: 0;
    white-space: nowrap;
}

/* Notification Enhanced Animation */
@keyframes notificationSlide {
    0% {
        opacity: 0;
        transform: translateX(100%) scale(0.9);
    }
    60% {
        transform: translateX(-10px) scale(1);
    }
    100% {
        opacity: 1;
        transform: translateX(0) scale(1);
    }
}

#notification {
    animation: notificationSlide 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
}

/* Professional Cimahi Technopark Header */
.profile-header {
    background: linear-gradient(135deg, #0C4A6E 0%, #0369A1 25%, #0EA5E9 50%, #38BDF8 75%, #7DD3FC 100%);
    position: relative;
    overflow: hidden;
    border-radius: 28px;
    box-shadow: 0 20px 60px rgba(14, 165, 233, 0.25);
}

.dark .profile-header {
    background: linear-gradient(135deg, #1E3A8A 0%, #1E40AF 25%, #2563EB 50%, #3B82F6 75%, #60A5FA 100%);
    box-shadow: 0 20px 60px rgba(37, 99, 235, 0.3);
}

/* Geometric Pattern Overlay */
.profile-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        linear-gradient(30deg, rgba(255,255,255,0.05) 12%, transparent 12.5%, transparent 87%, rgba(255,255,255,0.05) 87.5%, rgba(255,255,255,0.05)),
        linear-gradient(150deg, rgba(255,255,255,0.05) 12%, transparent 12.5%, transparent 87%, rgba(255,255,255,0.05) 87.5%, rgba(255,255,255,0.05)),
        linear-gradient(30deg, rgba(255,255,255,0.05) 12%, transparent 12.5%, transparent 87%, rgba(255,255,255,0.05) 87.5%, rgba(255,255,255,0.05)),
        linear-gradient(150deg, rgba(255,255,255,0.05) 12%, transparent 12.5%, transparent 87%, rgba(255,255,255,0.05) 87.5%, rgba(255,255,255,0.05));
    background-size: 80px 140px;
    background-position: 0 0, 0 0, 40px 70px, 40px 70px;
}

/* Tech Circuit Pattern */
.profile-header::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(255,255,255,0.15) 1px, transparent 1px);
    background-size: 30px 30px;
    animation: float 20s ease-in-out infinite;
    opacity: 0.6;
}

/* Professional Avatar Design */
.avatar-border-wrapper {
    position: relative;
    padding: 6px;
    background: linear-gradient(135deg, #0EA5E9, #38BDF8, #7DD3FC, #0EA5E9);
    background-size: 300% 300%;
    border-radius: 50%;
    animation: shimmer 4s ease infinite;
    box-shadow: 0 10px 40px rgba(14, 165, 233, 0.4);
}

.dark .avatar-border-wrapper {
    background: linear-gradient(135deg, #3B82F6, #60A5FA, #93C5FD, #3B82F6);
    box-shadow: 0 10px 40px rgba(59, 130, 246, 0.5);
}

.avatar-inner-border {
    padding: 4px;
    background: white;
    border-radius: 50%;
}

.dark .avatar-inner-border {
    background: #1F2937;
}

.avatar-image {
    width: 160px;
    height: 160px;
    border-radius: 50%;
    object-fit: cover;
    display: block;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
}

.avatar-status {
    position: absolute;
    bottom: 8px;
    right: 8px;
    width: 28px;
    height: 28px;
    background: linear-gradient(135deg, #10B981, #059669);
    border: 4px solid white;
    border-radius: 50%;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    animation: pulse-glow 2s ease-in-out infinite;
}

.dark .avatar-status {
    border-color: #1F2937;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.6);
}

/* Modern Badge System */
.role-badge::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.5s;
}

.role-badge:hover::before {
    left: 100%;
}

.badge-super-admin { 
    background: linear-gradient(135deg, #DC2626 0%, #EF4444 50%, #F87171 100%);
    color: white;
}
.badge-admin { 
    background: linear-gradient(135deg, #7C3AED 0%, #8B5CF6 50%, #A78BFA 100%);
    color: white;
}
.badge-pengurus-aset { 
    background: linear-gradient(135deg, #EA580C 0%, #F97316 50%, #FB923C 100%);
    color: white;
}
.badge-user { 
    background: linear-gradient(135deg, #0891B2 0%, #06B6D4 50%, #22D3EE 100%);
    color: white;
}

.info-badge {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    padding: 10px 20px;
    border-radius: 16px;
    color: white;
    font-weight: 600;
    font-size: 13px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

.dark .info-badge {
    background: rgba(31, 41, 55, 0.3);
    border-color: rgba(255, 255, 255, 0.2);
}

/* Professional Card Design */
.info-card {
    background: white;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
    border: 1px solid rgba(14, 165, 233, 0.1);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
}

.dark .info-card {
    background: #1F2937;
    border-color: #374151;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.3);
}

.info-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #0EA5E9, #38BDF8, #7DD3FC);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
}

.dark .info-card::before {
    background: linear-gradient(90deg, #3B82F6, #60A5FA, #93C5FD);
}

.info-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 48px rgba(14, 165, 233, 0.15);
}

.dark .info-card:hover {
    box-shadow: 0 12px 48px rgba(59, 130, 246, 0.2);
}

.info-card:hover::before {
    transform: scaleX(1);
}

/* Card Headers with Icon */
.card-header {
    padding: 28px 32px;
    background: linear-gradient(135deg, #F0F9FF 0%, #E0F2FE 100%);
    border-bottom: 2px solid #BAE6FD;
    position: relative;
}

.dark .card-header {
    background: linear-gradient(135deg, #1E3A8A 0%, #1E40AF 100%);
    border-bottom-color: #2563EB;
}

.card-header-gold {
    background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
    border-bottom: 2px solid #FDE68A;
}

.dark .card-header-gold {
    background: linear-gradient(135deg, #78350F 0%, #92400E 100%);
    border-bottom-color: #B45309;
}

.card-header-green {
    background: linear-gradient(135deg, #F0FDF4 0%, #DCFCE7 100%);
    border-bottom: 2px solid #BBF7D0;
}

.dark .card-header-green {
    background: linear-gradient(135deg, #14532D 0%, #166534 100%);
    border-bottom-color: #15803D;
}

.card-title {
    display: flex;
    align-items: center;
    gap: 16px;
    font-size: 20px;
    font-weight: 800;
    color: #0C4A6E;
}

.dark .card-title {
    color: #E0F2FE;
}

.card-title-gold {
    color: #78350F;
}

.dark .card-title-gold {
    color: #FEF3C7;
}

.card-title-green {
    color: #14532D;
}

.dark .card-title-green {
    color: #DCFCE7;
}

.card-icon {
    width: 56px;
    height: 56px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: white;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    position: relative;
}

.card-icon::before {
    content: '';
    position: absolute;
    inset: -3px;
    border-radius: 18px;
    background: inherit;
    opacity: 0.3;
    filter: blur(8px);
}

.card-icon-blue {
    background: linear-gradient(135deg, #0EA5E9, #0284C7);
}

.dark .card-icon-blue {
    background: linear-gradient(135deg, #3B82F6, #2563EB);
}

.card-icon-gold {
    background: linear-gradient(135deg, #F59E0B, #D97706);
}

.card-icon-green {
    background: linear-gradient(135deg, #10B981, #059669);
}

/* Info Rows */
.info-content {
    padding: 32px;
}

.info-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 0;
    background: linear-gradient(180deg, #0EA5E9, #38BDF8);
    border-radius: 0 4px 4px 0;
    transition: height 0.3s ease;
}

.dark .info-item::before {
    background: linear-gradient(180deg, #3B82F6, #60A5FA);
}

.info-item:hover {
    background: linear-gradient(135deg, #F0F9FF 0%, #E0F2FE 100%);
    border-color: #BAE6FD;
    transform: translateX(8px);
}

.dark .info-item:hover {
    background: linear-gradient(135deg, #1E3A8A 0%, #1E40AF 100%);
    border-color: #2563EB;
}

.info-item:hover::before {
    height: 60%;
}

.info-label {
    color: #64748B;
    font-weight: 700;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.dark .info-label {
    color: #94A3B8;
}

.info-value {
    color: #0F172A;
    font-size: 15px;
    font-weight: 600;
    line-height: 1.6;
}

.dark .info-value {
    color: #E2E8F0;
}

/* Activity Timeline */
.activity-timeline {
    position: relative;
    padding-left: 40px;
}

.activity-timeline::before {
    content: '';
    position: absolute;
    left: 20px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: linear-gradient(180deg, #0EA5E9, transparent);
}

.dark .activity-timeline::before {
    background: linear-gradient(180deg, #3B82F6, transparent);
}

.activity-item::before {
    content: '';
    position: absolute;
    left: -28px;
    top: 28px;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: linear-gradient(135deg, #0EA5E9, #38BDF8);
    border: 3px solid white;
    box-shadow: 0 0 0 4px #E0F2FE;
}

.dark .activity-item::before {
    background: linear-gradient(135deg, #3B82F6, #60A5FA);
    border-color: #1F2937;
    box-shadow: 0 0 0 4px #1E3A8A;
}

.activity-item:hover {
    border-color: #0EA5E9;
    box-shadow: 0 8px 32px rgba(14, 165, 233, 0.15);
    transform: translateX(8px);
}

.dark .activity-item:hover {
    border-color: #3B82F6;
    box-shadow: 0 8px 32px rgba(59, 130, 246, 0.2);
}

.activity-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #10B981, #059669);
    color: white;
    font-size: 20px;
    box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3);
}

/* Professional Edit Button */
.btn-edit-profile {
    background: white;
    color: #0EA5E9;
    padding: 14px 32px;
    border-radius: 16px;
    font-weight: 700;
    font-size: 15px;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(255, 255, 255, 0.4);
    border: 2px solid rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    text-decoration: none;
}

.dark .btn-edit-profile {
    background: rgba(31, 41, 55, 0.8);
    color: #60A5FA;
    border-color: rgba(59, 130, 246, 0.3);
    box-shadow: 0 4px 20px rgba(59, 130, 246, 0.2);
}

.btn-edit-profile:hover {
    background: rgba(255, 255, 255, 0.95);
    transform: translateY(-2px);
    box-shadow: 0 8px 32px rgba(255, 255, 255, 0.6);
    color: #0284C7;
}

.dark .btn-edit-profile:hover {
    background: rgba(31, 41, 55, 0.95);
    box-shadow: 0 8px 32px rgba(59, 130, 246, 0.3);
    color: #93C5FD;
}

/* Breadcrumb */
.breadcrumb-modern {
    display: flex;
    align-items: center;
    gap: 12px;
    background: white;
    padding: 16px 24px;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    border: 1px solid rgba(14, 165, 233, 0.1);
}

.dark .breadcrumb-modern {
    background: #1F2937;
    border-color: #374151;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
}

.breadcrumb-link {
    color: #64748B;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.2s ease;
    text-decoration: none;
}

.dark .breadcrumb-link {
    color: #94A3B8;
}

.breadcrumb-link:hover {
    color: #0EA5E9;
}

.dark .breadcrumb-link:hover {
    color: #60A5FA;
}

.breadcrumb-current {
    color: #0F172A;
    font-weight: 700;
    font-size: 14px;
}

.dark .breadcrumb-current {
    color: #F1F5F9;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 32px;
}

.empty-state-icon {
    width: 120px;
    height: 120px;
    margin: 0 auto 24px;
    border-radius: 28px;
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1));
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.dark .empty-state-icon {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(5, 150, 105, 0.2));
}

.empty-state-icon::before {
    content: '';
    position: absolute;
    inset: -8px;
    border-radius: 32px;
    background: inherit;
    opacity: 0.5;
    filter: blur(12px);
}

/* Notification */
.notification-modern {
    background: white;
    border-radius: 20px;
    box-shadow: 0 12px 48px rgba(0, 0, 0, 0.15);
    overflow: hidden;
    max-width: 420px;
}

.dark .notification-modern {
    background: #1F2937;
    box-shadow: 0 12px 48px rgba(0, 0, 0, 0.4);
}

.notification-content {
    padding: 24px;
    display: flex;
    align-items: start;
    gap: 16px;
}

.notification-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 20px;
    color: white;
}

.notification-progress {
    height: 4px;
    background: linear-gradient(90deg, #10B981, #059669);
    animation: progress 5s linear;
}

@keyframes progress {
    from { width: 100%; }
    to { width: 0%; }
}

/* Reduce Motion for Accessibility */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* Responsive */
@media (max-width: 1024px) {
    .info-item {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    
    .avatar-image {
        width: 120px;
        height: 120px;
    }
    
    .profile-header {
        border-radius: 20px;
    }
}

/* COMPACT MODIFICATIONS */
@media (max-width: 1024px) {
    /* Compact Header */
    .profile-header {
        border-radius: 16px;
        padding: 0 !important;
    }
    
    .profile-header > div {
        padding: 1.5rem 1rem !important;
    }
    
    /* Smaller Avatar */
    .avatar-border-wrapper {
        padding: 4px;
    }
    
    .avatar-image {
        width: 80px !important;
        height: 80px !important;
    }
    
    .avatar-status {
        width: 18px;
        height: 18px;
        border-width: 3px;
        bottom: 4px;
        right: 4px;
    }
    
    /* Compact Typography */
    .profile-header h1 {
        font-size: 1.5rem !important;
        margin-bottom: 0.5rem !important;
    }
    
    .profile-header p {
        font-size: 0.875rem !important;
        margin-bottom: 0.75rem !important;
    }
    
    /* Smaller Badges */
    .role-badge {
        padding: 6px 12px !important;
        font-size: 0.7rem !important;
        gap: 6px !important;
    }
    
    .role-badge i {
        font-size: 0.75rem;
    }
    
    .info-badge {
        padding: 6px 12px !important;
        font-size: 0.7rem !important;
        gap: 6px !important;
    }
    
    /* Compact Edit Button */
    .btn-edit-profile {
        padding: 8px 16px !important;
        font-size: 0.8rem !important;
        gap: 6px !important;
        border-radius: 12px !important;
    }
    
    /* Compact Breadcrumb */
    .breadcrumb-modern {
        padding: 10px 16px !important;
        margin-bottom: 1rem !important;
        border-radius: 12px !important;
        gap: 8px !important;
    }
    
    .breadcrumb-link,
    .breadcrumb-current {
        font-size: 0.8rem !important;
    }
    
    /* Compact Cards */
    .info-card {
        border-radius: 16px !important;
        margin-bottom: 1rem !important;
    }
    
    .card-header {
        padding: 16px 20px !important;
    }
    
    .card-title {
        font-size: 1rem !important;
        gap: 10px !important;
    }
    
    .card-icon {
        width: 36px !important;
        height: 36px !important;
        border-radius: 10px !important;
        font-size: 16px !important;
    }
    
    .info-content {
        padding: 20px !important;
    }
    
    /* Compact Info Items */
    .info-item {
        grid-template-columns: 1fr !important;
        gap: 8px !important;
        padding: 12px !important;
        border-radius: 10px !important;
        margin-bottom: 8px !important;
    }
    
    .info-label {
        font-size: 0.7rem !important;
        gap: 6px !important;
    }
    
    .info-label i {
        font-size: 0.75rem;
    }
    
    .info-value {
        font-size: 0.875rem !important;
        line-height: 1.4 !important;
    }
    
    /* Compact Activity Timeline */
    .activity-timeline {
        padding-left: 30px !important;
    }
    
    .activity-timeline::before {
        left: 15px !important;
    }
    
    .activity-item {
        padding: 16px !important;
        margin-bottom: 12px !important;
        border-radius: 12px !important;
    }
    
    .activity-item::before {
        left: -22px !important;
        top: 20px !important;
        width: 12px !important;
        height: 12px !important;
        border-width: 2px !important;
    }
    
    .activity-icon {
        width: 36px !important;
        height: 36px !important;
        border-radius: 10px !important;
        font-size: 16px !important;
    }
    
    .activity-item h4 {
        font-size: 0.875rem !important;
        margin-bottom: 0.5rem !important;
    }
    
    .activity-item p {
        font-size: 0.75rem !important;
        margin-bottom: 0.5rem !important;
    }
    
    .activity-item .text-xs {
        font-size: 0.7rem !important;
    }
    
    /* Compact Empty State */
    .empty-state {
        padding: 40px 20px !important;
    }
    
    .empty-state-icon {
        width: 80px !important;
        height: 80px !important;
        margin-bottom: 16px !important;
        border-radius: 16px !important;
    }
    
    .empty-state-icon i {
        font-size: 2.5rem !important;
    }
    
    .empty-state h4 {
        font-size: 1.25rem !important;
        margin-bottom: 0.5rem !important;
    }
    
    .empty-state p {
        font-size: 0.875rem !important;
    }
    
    /* Compact Notification */
    .notification-modern {
        border-radius: 12px !important;
        max-width: 320px !important;
    }
    
    .notification-content {
        padding: 16px !important;
        gap: 12px !important;
    }
    
    .notification-icon {
        width: 36px !important;
        height: 36px !important;
        border-radius: 10px !important;
        font-size: 16px !important;
    }
    
    .notification-content h4 {
        font-size: 0.875rem !important;
        margin-bottom: 0.25rem !important;
    }
    
    .notification-content p {
        font-size: 0.75rem !important;
    }
    
    /* Reduce spacing */
    .max-w-7xl {
        padding-top: 0.5rem !important;
        padding-bottom: 0.5rem !important;
    }
    
    .grid.gap-6 {
        gap: 1rem !important;
    }
    
    /* Hide decorative elements on mobile */
    .profile-header::after {
        display: none !important;
    }
}

/* Extra compact for small screens */
@media (max-width: 640px) {
    .avatar-image {
        width: 64px !important;
        height: 64px !important;
    }
    
    .profile-header h1 {
        font-size: 1.25rem !important;
    }
    
    .card-title {
        font-size: 0.875rem !important;
    }
    
    .info-value {
        font-size: 0.8rem !important;
    }
}
</style>
@endpush

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 lg:py-4">       
        <!-- Modern Breadcrumb -->
        <nav class="breadcrumb-modern mb-8 animate-smooth-fade" aria-label="Breadcrumb">
            <a href="{{ route('dashboard') }}" class="breadcrumb-link flex items-center gap-2">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs"></i>
            <span class="breadcrumb-current flex items-center gap-2">
                <i class="fas fa-user-circle"></i>
                <span>Profil Saya</span>
            </span>
        </nav>

        <!-- Professional Profile Header -->
        <div class="profile-header mb-8 animate-gentle-scale delay-100">
            <div class="relative z-10 px-8 py-16">
                <div class="flex flex-col lg:flex-row items-center gap-10">
                    
                    <!-- Professional Avatar -->
                    <div class="avatar-container">
                        <div class="avatar-border-wrapper">
                            <div class="avatar-inner-border">
                                <img src="{{ $user->avatar_url }}" 
                                     alt="{{ $user->name }}"
                                     class="avatar-image">
                            </div>
                        </div>
                        <div class="avatar-status"></div>
                    </div>
                    
                    <!-- User Information -->
                    <div class="flex-1 text-center lg:text-left">
                        <h1 class="text-5xl font-black text-white mb-4 tracking-tight drop-shadow-lg">
                            {{ $user->name }}
                        </h1>
                        <p class="text-white/95 text-lg mb-6 flex items-center justify-center lg:justify-start gap-3 font-semibold drop-shadow">
                            <i class="fas fa-envelope-open"></i>
                            {{ $user->email }}
                        </p>
                        <div class="flex flex-wrap gap-4 justify-center lg:justify-start items-center">
                            @if($user->role == 'super_admin')
                                <span class="role-badge badge-super-admin">
                                    <i class="fas fa-crown"></i>
                                    Super Admin
                                </span>
                            @elseif($user->role == 'admin')
                                <span class="role-badge badge-admin">
                                    <i class="fas fa-user-shield"></i>
                                    Administrator
                                </span>
                            @elseif($user->role == 'pengurus_aset')
                                <span class="role-badge badge-pengurus-aset">
                                    <i class="fas fa-boxes"></i>
                                    Pengurus Aset
                                </span>
                            @else
                                <span class="role-badge badge-user">
                                    <i class="fas fa-user"></i>
                                    User
                                </span>
                            @endif
                            
                            <span class="info-badge">
                                <i class="fas fa-calendar-check"></i>
                                Bergabung {{ $user->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Edit Profile Button -->
                    <div class="lg:ml-auto animate-smooth-slide-right delay-300">
                        <a href="{{ route('profile.edit') }}" class="btn-edit-profile">
                            <i class="fas fa-edit"></i>
                            <span>Edit Profil</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Information Cards Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            
            <!-- Personal Information Card -->
            <div class="info-card animate-elegant-slide delay-200">
                <div class="card-header">
                    <div class="card-title">
                        <div class="card-icon card-icon-blue">
                            <i class="fas fa-id-card-alt"></i>
                        </div>
                        <span>Informasi Pribadi</span>
                    </div>
                </div>
                
                <div class="info-content space-y-2">
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-user-circle"></i>
                            Nama Lengkap
                        </div>
                        <div class="info-value">{{ $user->name }}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-envelope"></i>
                            Email
                        </div>
                        <div class="info-value">{{ $user->email }}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-phone"></i>
                            No. Telepon
                        </div>
                        <div class="info-value">{{ $user->no_telp ?? '-' }}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-id-card"></i>
                            No. KTP
                        </div>
                        <div class="info-value">{{ $user->no_ktp ?? '-' }}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-map-marker-alt"></i>
                            Alamat
                        </div>
                        <div class="info-value">
                            @if($user->alamat)
                                {{ $user->alamat }}<br>
                                {{ $user->kelurahan ? 'Kel. ' . $user->kelurahan : '' }}
                                {{ $user->kecamatan ? ', Kec. ' . $user->kecamatan : '' }}<br>
                                {{ $user->kabupaten ?? '' }}
                                {{ $user->kode_pos ? ' ' . $user->kode_pos : '' }}
                            @else
                                -
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Organization Information Card -->
            <div class="info-card animate-elegant-slide delay-300">
                <div class="card-header card-header-gold">
                    <div class="card-title card-title-gold">
                        <div class="card-icon card-icon-gold">
                            <i class="fas fa-building"></i>
                        </div>
                        <span>Informasi Organisasi</span>
                    </div>
                </div>
                
                <div class="info-content space-y-2">
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-briefcase"></i>
                            Jabatan
                        </div>
                        <div class="info-value">{{ $user->jabatan ?? '-' }}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-university"></i>
                            Instansi
                        </div>
                        <div class="info-value">{{ $user->instansi ?? '-' }}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-users"></i>
                            Organisasi
                        </div>
                        <div class="info-value">{{ $user->nama_organisasi ?? '-' }}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-shield-alt"></i>
                            Role Akses
                        </div>
                        <div>
                            @if($user->role == 'super_admin')
                                <span class="role-badge badge-super-admin">
                                    <i class="fas fa-crown"></i>
                                    Super Admin
                                </span>
                            @elseif($user->role == 'admin')
                                <span class="role-badge badge-admin">
                                    <i class="fas fa-user-shield"></i>
                                    Administrator
                                </span>
                            @elseif($user->role == 'pengurus_aset')
                                <span class="role-badge badge-pengurus-aset">
                                    <i class="fas fa-boxes"></i>
                                    Pengurus Aset
                                </span>
                            @else
                                <span class="role-badge badge-user">
                                    <i class="fas fa-user"></i>
                                    User
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities Timeline -->
        <div class="info-card animate-professional-reveal delay-400">
            <div class="card-header card-header-green">
                <div class="card-title card-title-green">
                    <div class="card-icon card-icon-green">
                        <i class="fas fa-history"></i>
                    </div>
                    <span>Aktivitas Terbaru</span>
                </div>
            </div>
            
            <div class="info-content">
                @if($recentActivities->count() > 0)
                <div class="activity-timeline">
                    @foreach($recentActivities as $index => $activity)
                    <div class="activity-item" style="animation-delay: {{ $index * 0.1 }}s">
                        <div class="flex items-start gap-4">
                            <div class="activity-icon">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $activity->aksi }}</h4>
                                @if($activity->detail)
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 leading-relaxed">{{ $activity->detail }}</p>
                                @endif
                                <p class="text-xs font-bold text-emerald-600 dark:text-emerald-400 flex items-center gap-2">
                                    <i class="fas fa-clock"></i>
                                    {{ $activity->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-history text-6xl text-emerald-400 relative z-10"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-3">Belum Ada Aktivitas</h4>
                    <p class="text-gray-600 dark:text-gray-400 text-lg">Aktivitas Anda akan tercatat dan muncul di sini</p>
                </div>
                @endif
            </div>
        </div>

    </div>

    <!-- Modern Success Notification -->
    @if(session('success'))
    <div id="notification" class="fixed top-6 right-6 z-50">
        <div class="notification-modern">
            <div class="notification-content">
                <div class="notification-icon" style="background: linear-gradient(135deg, #10B981, #059669);">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-1">Berhasil!</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ session('success') }}</p>
                </div>
                <button onclick="hideNotification()" class="flex-shrink-0 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition-colors ml-2">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <div class="notification-progress"></div>
        </div>
    </div>
    @endif

    <!-- Modern Error Notification -->
    @if(session('error'))
    <div id="notification" class="fixed top-6 right-6 z-50">
        <div class="notification-modern">
            <div class="notification-content">
                <div class="notification-icon" style="background: linear-gradient(135deg, #EF4444, #DC2626);">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-1">Terjadi Kesalahan!</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ session('error') }}</p>
                </div>
                <button onclick="hideNotification()" class="flex-shrink-0 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition-colors ml-2">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <div class="notification-progress" style="background: linear-gradient(90deg, #EF4444, #DC2626);"></div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function hideNotification() {
    const notification = document.getElementById('notification');
    if (notification) {
        notification.style.transform = 'scale(0.9)';
        notification.style.opacity = '0';
        notification.style.transition = 'all 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }
}

// Auto hide notifications after 5 seconds
@if(session('success') || session('error'))
setTimeout(() => hideNotification(), 5000);
@endif

// Add smooth scroll behavior
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add loading state to edit button
const editButton = document.querySelector('.btn-edit-profile');
if (editButton) {
    editButton.addEventListener('click', function(e) {
        const icon = this.querySelector('i');
        icon.classList.remove('fa-edit');
        icon.classList.add('fa-spinner', 'fa-spin');
    });
}

// Animate elements on scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe all cards
document.querySelectorAll('.info-card').forEach(card => {
    observer.observe(card);
});

// Console log
console.log('%c✅ Profile Page with Dark Mode Loaded', 'color: #3B82F6; font-size: 14px; font-weight: bold;');
console.log('%c🌓 Dark Mode Support Active!', 'color: #10B981; font-size: 12px;');
</script>
@endpush