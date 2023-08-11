<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Copeland - Drum sets configurator</title>
     <?php include_once './../includes/bootstrap_css.html'; ?>
     <style>
          .drag-to-scroll-items {
               scrollbar-width: thin;
               scrollbar-color: var(--secondary) var(--primary);
          }

          .drag-to-scroll-items::-webkit-scrollbar {
               width: 15px;
          }
     </style>
</head>

<body>

     <?php
     include_once './../includes/header/header_choosed.inc.php';
     ?>

     <main class="container py-3">

          <section>
               <h2 class="fs-1 ms-2">MOST POPULAR ITEMS</h2>
               <div class="d-flex overflow-auto drag-to-scroll-items" style="height:min-content; cursor: grab;">
                    <?php
                    require('./../includes/db_connection.php');
                    
                    function convertToTitleCase($input) {
                         $words = explode("_", $input);
                         $formattedWords = array_map('ucwords', $words);
                         return implode(" ", $formattedWords);
                    }

                    $query = "SELECT items.item_name, categories.category_name, items.size, items.items_view_count FROM items JOIN categories ON categories.category_id = items.category_id ORDER BY items.items_view_count DESC LIMIT 5;";
                    $result = $conn->query($query);
          
                    if ($result->num_rows > 0) {
                         while ($row = $result->fetch_assoc()) {
                              echo '<div class="px-2 col-10 col-lg-4 mx-auto mx-lg-0 my-2">
                              <div class="card">
                              <div class="card-body row">
                              <div class="col-9">
                              <form method="get" action="item.php">
                              <input type="hidden" name="item_name" value="' . $row['item_name'] . '">
                              <input type="hidden" name="category_name" value="' . convertToTitleCase($row['category_name']) . '">
                              <input type="hidden" name="size" value="' . $row['size'] . '">
                              <input type="hidden" name="view_count" value="' . $row['items_view_count'] . '">
                              <h4 class="m-0" class="card-title">
                              <input type="submit" class="m-0 p-0 border-0 bg-white" value="' . $row['item_name'] . '">
                              </h4>
                              </form>
                              <p class="my-2" style="font-size: 15px;">CATEGORY: ' . convertToTitleCase($row['category_name']) . '</p>
                              <p class="my-2" style="font-size: 15px;">SIZE: ' . $row['size'] . '</p>
                              </div>
                              <div class="col-3 d-flex align-items-center justify-content-center">
                              <button type="button" class="btn btn-primary">+</button>
                              </div>
                              </div>
                              </div>
                              </div>';
                         }
                    } else {
                         echo "<p><strong>There are no items</strong></p>";
                    }


                    $conn->close();
                    ?>
               </div>
          </section>

     </main>

     <?php
     include_once './../includes/footer.html';
     ?>
     <?php include_once './../includes/bootstrap_js.html'; ?>

     <script>
          const slider = document.querySelector('.drag-to-scroll-items')
          let isDown = false
          let startX
          let scrollLeft

          slider.addEventListener('mousedown', (e) => {
               let rect = slider.getBoundingClientRect()
               isDown = true
               slider.classList.add('active')
               startX = e.pageX - rect.left
               scrollLeft = slider.scrollLeft
               console.log(startX, scrollLeft)
          })

          slider.addEventListener('mouseleave', () => {
               isDown = false
               slider.dataset.dragging = false
               slider.classList.remove('active')
          })

          slider.addEventListener('mouseup', () => {
               isDown = false
               slider.dataset.dragging = false
               slider.classList.remove('active')
          })

          slider.addEventListener('mousemove', (e) => {
               if (!isDown) return
               let rect = slider.getBoundingClientRect()
               e.preventDefault()
               slider.dataset.dragging = true
               const x = e.pageX - rect.left
               const walk = (x - startX)
               slider.scrollLeft = scrollLeft - walk
               console.log(x, walk, slider.scrollLeft)
          })
     </script>
     <script src="./../js/popover.js"></script>
</body>

</html>