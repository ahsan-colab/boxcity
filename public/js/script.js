jQuery(document).ready(function($) {
    $('.slider').slick({
        slidesToShow: 3,           
        slidesToScroll: 1,         
        infinite: true,            
        arrows: true, 
        responsive: [
          {
            breakpoint: 1100,
            settings: {
              slidesToShow: 2,
              arrows:false,
            }
          },
          {
            breakpoint: 821,
            settings: {
              slidesToShow: 1
            }
          }
        ]
      });
    
    });
    
    document.addEventListener('DOMContentLoaded', function () {
        const locationItems = document.querySelectorAll('.list-group-item');
        const locationInfos = document.querySelectorAll('.location-info');
      
        locationItems.forEach(item => {
          item.addEventListener('click', function () {
            // Remove active class from all items and details
            locationItems.forEach(i => i.classList.remove('active'));
            locationInfos.forEach(info => info.classList.remove('active'));
      
            // Add active class to clicked item and corresponding details
            const location = this.dataset.location;
            this.classList.add('active');
            document.getElementById(location).classList.add('active');
          });
        });
      });