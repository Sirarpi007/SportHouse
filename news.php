<?php
$conn = new mysqli("localhost", "root", "", "sport_news");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Սպորտային Լուրեր</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
<header>
  <h1><i class="fa-solid fa-trophy"></i> ՍպորտՏուն</h1>
  <nav class="nav-links">
    <a href="index.html"><i class="fa-solid fa-futbol"></i> Հաշիվներ</a>
    <a href="news.php" class="active"><i class="fa-solid fa-newspaper"></i> Լուրեր</a>
  </nav>
</header>
<main class="content wide">
  <h2><i class="fa-solid fa-globe"></i> Սպորտային Լուրեր ըստ Սպորտաձևերի</h2>
  <div class="filter-buttons">
    <button onclick="filterNews('all')" class="active">Բոլորը</button>
    <button onclick="filterNews('football')">Ֆուտբոլ</button>
    <button onclick="filterNews('basketball')">Բասկետբոլ</button>
    <button onclick="filterNews('tennis')">Թենիս</button>
    <button onclick="filterNews('hockey')">Հոկեյ</button>
    <button onclick="filterNews('volleyball')">Վոլեյբոլ</button>
    <button onclick="filterNews('boxing')">Բոքս</button>
    <button onclick="filterNews('cricket')">Կրիկետ</button>
  </div>
  <section class="news-grid" id="newsGrid">
<?php
$sports = [
  "football" => [
    ["title"=>"«Բարսելոնան» հաղթում է Մադրիդին","img"=>"https://tse2.mm.bing.net/th/id/OIP.3IBBWzS2mOoOwskIljiJjAHaEK?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3","text"=>"2-2 հաշվով ոչ-ոքիի արդյունքում երկու թիմերն էլ ցուցադրեցին հիանալի խաղ՝ լի հետաքրքիր պահերով։"],
    ["title"=>"Ատետիկոն բարձրանում է թոփ 3","img"=>"https://thumb2.besoccerapps.com/rbetis/img_news/43/43667.jpg","text"=>"Ատետիկոն բարձրանում է 3րդ հորիզոնական 3։1 Բետիսի դեմ խաղի արդյունքում"],
    ["title"=>"Ռեալ Մադրիդի նորաստեղծ 11-ը","img"=>"https://tse3.mm.bing.net/th/id/OIP.i2mBQ4w7QXpRymEKuFCe2QHaE8?w=1920&h=1280&rs=1&pid=ImgDetMain&o=7&rm=3","text"=>"Ռեալ Մադրիդը հանդես եկավ նոր կազմով ու անակնկալ խաղ ցուցադրեց։"]
  ],
  "basketball" => [
    ["title"=>"Լեյքերս հաղթում է Վարիորսին","img"=>"https://cdn.nba.com/logos/nba/1610612747/primary/L/logo.svg","text"=>"114-109 հաշվով եզրափակիչ խաղում Լեյքերսը հաղթեց։"],
    ["title"=>"Ռեալ Մադրիդը հաղթում է Ֆեներբահչեին","img"=>"https://cdnuploads.aa.com.tr/uploads/Contents/2020/11/21/thumbs_b_c_2393ac86a3e6a6f07dd0cd4fab48c7d7.jpg?v=052145","text"=>"91-84 հաշվով եվրոպական խաղում հաղթանակ։"],
    ["title"=>"Չիկագո Բուլզը հաղթում է Մայամի Հիթին","img"=>"https://cdn.nba.com/logos/nba/1610612741/primary/L/logo.svg","text"=>"102-98 հաշվով Չիկագոն հաղթեց։"]
  ],
  "tennis" => [
    ["title"=>"Ջոկովիչ հաղթում է Մեդվեդևին","img"=>"https://th.bing.com/th/id/R.bbc7bded957d661235576efc318809ec?rik=NFOGKeijFq9mMQ&pid=ImgRaw&r=0","text"=>"2-1 հաշվով սենսացիոն հաղթանակ։"],
    ["title"=>"Սվյոնտեկ հաղթում է Սաբալենկային","img"=>"https://tse1.mm.bing.net/th/id/OIP.q3123OlSvWCniG752aqOgAHaE7?rs=1&pid=ImgDetMain&o=7&rm=3","text"=>"2-0 հաշվով մրցանակակիր։"],
    ["title"=>"Ալկանտարան հաղթում է Ջոնսին","img"=>"https://d2me2qg8dfiw8u.cloudfront.net/content/uploads/2024/06/10143534/ATP-grass-picks-USE.jpg","text"=>"Մեծ հաղթանակ՝ 3-1 հաշվով։"]
  ],
  "hockey" => [
    ["title"=>"Տորոնտոն հաղթում է Բոստոնին","img"=>"https://i.ytimg.com/vi/7xJ3NEu_joA/maxresdefault.jpg","text"=>"4-3 հաշվով ԱԺ փուլում հաղթանակ։"],
    ["title"=>"ԲԿՄԱ Մոսկվան հաղթում է ՍԿԱ Ս․ Պետերբուրգին","img"=>"https://tse1.mm.bing.net/th/id/OIP.iPnZElQXRLHw_zOKCeeaOQHaGM?rs=1&pid=ImgDetMain&o=7&rm=3","text"=>"1-0 հաշվով եզրափակիչում։"]
  ],
  "volleyball" => [
    ["title"=>"Բրազիլիան հաղթում է Իտալիային","img"=>"https://tse1.mm.bing.net/th/id/OIP._cKKjWrh-jMdQEh4papeFwHaE8?rs=1&pid=ImgDetMain&o=7&rm=3","text"=>"3-2 հաշվով ՖԻՎԲ Ազգերի լիգայում։"]
  ],
  "boxing" => [
    ["title"=>"Թայսոն Ֆյուրի հաղթում է Ուսիկին","img"=>"https://static0.givemesportimages.com/wordpress/wp-content/uploads/2025/03/mixcollage-20-mar-2025-10-16-am-3427.jpg?q=49&fit=crop&w=825&dpr=2","text"=>"Ծանր քաշային կարգի հաղթանակ։"]
  ],
  "cricket" => [
    ["title"=>"Հնդկաստանը հաղթում է Ավստրալիային","img"=>"https://tse4.mm.bing.net/th/id/OIP.9JWOzPeiGip0iPSATZ5qoAHaEK?rs=1&pid=ImgDetMain&o=7&rm=3","text"=>"285/6 vs 279/9՝ Հնդկաստանը հաղթեց 6 ռաներով։"]
  ]
];
foreach($sports as $sport => $newsArray){
  foreach($newsArray as $news){
    echo '<article class="news-card" data-sport="'.$sport.'">';
    echo '<img src="'.$news['img'].'" alt="'.$news['title'].'">';
    echo '<h4>'.$news['title'].'</h4>';
    echo '<p>'.$news['text'].'</p>';
    echo '<button class="comment-btn" onclick="openModal(\''.$news['title'].'\')"><i class="fa-solid fa-comment"></i> Մեկնաբանություն</button>';
    echo '</article>';}}
?>
  </section>
</main>
<div id="commentModal" class="modal">
  <div class="modal-content">
    <button class="close-btn" onclick="closeModal()">X</button>
    <div id="modalTitle"></div>
    <input type="text" id="name" placeholder="Օգտանուն">
    <input type="email" id="email" placeholder="Էլ․ հասցե">
    <textarea id="comment" placeholder="Գրեք այստեղ..." rows="3"></textarea>
    <button type="button" onclick="saveComment()">Հաստատել</button>
    <div id="commentStatus" style="margin-top:5px;color:#00ffea;font-size:13px;"></div>
    <div id="commentList" class="comment-list"></div>
  </div>
</div>
<script>
let currentTitle = '';
function openModal(title){
  currentTitle = title;
  document.getElementById('modalTitle').innerText = title;
  document.getElementById('commentModal').style.display = 'flex';
  loadComments(title);
}
function closeModal(){
  document.getElementById('commentModal').style.display = 'none';
  document.getElementById('name').value='';
  document.getElementById('email').value='';
  document.getElementById('comment').value='';
  document.getElementById('commentStatus').innerText='';
}
function saveComment(){
  const name = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim();
  const comment = document.getElementById('comment').value.trim();
  if(!name || !email || !comment){
    document.getElementById('commentStatus').innerText='Խնդրում ենք լրացնել բոլոր դաշտերը';
    return;
  }
  fetch('save_comment.php',{
    method:'POST',
    headers:{'Content-Type':'application/x-www-form-urlencoded'},
    body:`title=${encodeURIComponent(currentTitle)}&name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&comment=${encodeURIComponent(comment)}`
  })
  .then(r=>r.text())
  .then(res=>{
    document.getElementById('commentStatus').innerText='Հաստատված է!';
    document.getElementById('name').value='';
    document.getElementById('email').value='';
    document.getElementById('comment').value='';
    loadComments(currentTitle);
  });}
function loadComments(title){
  fetch(`show_comments.php?title=${encodeURIComponent(title)}`)
  .then(r=>r.json())
  .then(data=>{
    let html='';
    if(data.length===0){
      html="<p>Դեռ ոչինչ չկա.</p>";
    } else {
      data.forEach(c=>{
        html+=`<div><strong>${c.name}</strong> <small>${c.created_at}</small><p>${c.comment}</p></div>`;
      });
    }
    document.getElementById('commentList').innerHTML=html;
  });
}
function filterNews(sport){
  const allBtns = document.querySelectorAll('.filter-buttons button');
  allBtns.forEach(b=>b.classList.remove('active'));
  event.target.classList.add('active');
  const cards = document.querySelectorAll('.news-card');
  cards.forEach(c=>{
    if(sport==='all' || c.dataset.sport===sport){
      c.style.display='block';
    } else {
      c.style.display='none';
    }
  });
}
</script>
</body>
</html>