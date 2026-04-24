<!-- Welcome & Connect Section -->
<section class="welcome-connect-section">
    <div class="container">
        <div class="welcome-connect-wrapper">
            <!-- Welcome Content -->
            <div class="welcome-content">
                <div class="section-heading text-left mb-4">
                    <h2 class="welcome-title">Welcome to ASFI Research Journal</h2>
                </div>
                <div class="welcome-text">
                    <p>
               Welcome to the <b class="font-bold" style="font-weight:999 !important; color:black;">African Science Frontiers Initiatives Research Journal (ASFIRJ)</b>—the official journal of the African Science Frontiers Initiatives. ASFIRJ is an online, open-access, multidisciplinary journal dedicated to publishing high-quality research across all fields, from basic to applied sciences. We provide an author-friendly platform and welcome contributions from researchers worldwide, ensuring a global perspective. Our mission is to advance impactful science and position ASFIRJ as a leading, globally competitive African research journal. All submissions are evaluated solely on scientific merit and quality.
                    </p>
                    <p>
                      <b class="font-bold" style="font-weight:999 !important; color:black;">Join us in advancing research, innovation, and collaboration.</b>
                    </p>
                    <!-- <p>
                        Join us in our mission to foster collaboration, innovation, and excellence in research. Together, let's explore new frontiers and make a lasting impact on the scientific landscape.
                    </p> -->

                            <!-- <p><em>ASFIRJ</em>, the official journal of the African Science Frontiers Initiatives (ASFI), stands as an online-only, open-access multidisciplinary journal, dedicated to advancing, impacting, and communicating research from all disciplines, encompassing both basic and applied studies. Within the African scientific community, <em>ASFIRJ</em> endeavors to provide an unparalleled platform, offering an author-friendly approach to scientific publishing from manuscript submission through publication. Our overarching ambition is to emerge as one of Africa's leading research journals, globally competitive, and unwaveringly focused on delivering quality research with significant impact.</p> -->

                </div>
            </div>

        
        </div>
    </div>
</section>

<style>
    .welcome-connect-section {
        padding: 60px 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    }
    
    .welcome-connect-wrapper {
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .welcome-title {
        font-size: 36px;
        font-weight: 700;
        color: #2c2c2c;
        margin-bottom: 20px;
        position: relative;
        display: inline-block;
        padding-bottom: 15px;
    }
    
    .welcome-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 5%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, #80078b, #ffbf00);
        border-radius: 3px;
    }
    
    .welcome-text {
        max-width: 900px;
        margin: 0 auto;
    }
    
    .welcome-text p {
        font-size: 16px;
        line-height: 1.8;
        color: #555;
        margin-bottom: 20px;
        text-align: justify;
    }
    
    .action-cards {
        display: flex;
        gap: 30px;
        margin: 50px 0 40px;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .action-card {
        flex: 1;
        min-width: 280px;
        max-width: 350px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }
    
    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(128,7,139,0.12);
    }
    
    .action-card-inner {
        padding: 30px 25px;
        text-align: center;
        position: relative;
        z-index: 1;
    }
    
    .action-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, rgba(128,7,139,0.1) 0%, rgba(255,191,0,0.1) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        transition: all 0.3s ease;
    }
    
    .action-icon i {
        font-size: 32px;
        color: #80078b;
    }
    
    .action-card:hover .action-icon {
        background: linear-gradient(135deg, #80078b 0%, #9b2cac 100%);
    }
    
    .action-card:hover .action-icon i {
        color: #fff;
    }
    
    .action-card h3 {
        font-size: 22px;
        font-weight: 700;
        color: #2c2c2c;
        margin-bottom: 12px;
    }
    
    .action-card p {
        font-size: 14px;
        line-height: 1.6;
        color: #666;
        margin-bottom: 20px;
    }
    
    .action-btn {
        display: inline-block;
        padding: 12px 28px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .action-btn.primary {
        background: linear-gradient(135deg, #80078b 0%, #9b2cac 100%);
        color: #fff;
        box-shadow: 0 4px 12px rgba(128,7,139,0.3);
    }
    
    .action-btn.primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(128,7,139,0.4);
    }
    
    .action-btn.secondary {
        background: transparent;
        color: #80078b;
        border: 2px solid #80078b;
    }
    
    .action-btn.secondary:hover {
        background: #80078b;
        color: #fff;
        transform: translateY(-2px);
    }
    
    .social-connect {
        text-align: center;
        padding-top: 20px;
        border-top: 1px solid #e0e0e0;
    }
    
    .social-connect h4 {
        font-size: 18px;
        font-weight: 600;
        color: #555;
        margin-bottom: 20px;
    }
    
    .social-icons {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .social-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: 22px;
    }
    
    .social-icon.whatsapp {
        background: #25D366;
        color: #fff;
    }
    
    .social-icon.linkedin {
        background: #0077B5;
        color: #fff;
    }
    
    .social-icon.instagram {
        background: linear-gradient(45deg, #f09433, #d62976, #962fbf);
        color: #fff;
    }
    
    .social-icon.twitter {
        background: #1DA1F2;
        color: #fff;
    }
    
    .social-icon:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    
    @media (max-width: 768px) {
        .welcome-connect-section {
            padding: 40px 0;
        }
        
        .welcome-title {
            font-size: 28px;
        }
        
        .welcome-text p {
            font-size: 14px;
        }
        
        .action-cards {
            gap: 20px;
        }
        
        .action-card {
            min-width: 100%;
        }
        
        .social-icon {
            width: 45px;
            height: 45px;
            font-size: 18px;
        }
    }
</style>