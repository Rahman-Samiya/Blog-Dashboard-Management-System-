<main style="
  background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
  padding: 4rem 1.5rem;
  font-family: 'Open Sans', Arial, sans-serif;
  color: #2a2e35;
  display: flex;
  justify-content: center;
">
  <section style="
    background: white;
    max-width: 800px;
    border-radius: 16px;
    box-shadow: 0 12px 36px rgba(0,0,0,0.1);
    padding: 3rem 3.5rem;
    text-align: center;
  ">
    <h1 style="
      font-size: 2.8rem;
      margin-bottom: 0.4rem;
      font-weight: 700;
      color: #34495e;
      position: relative;
    ">
      About Us
      <span style="
        display: block;
        height: 4px;
        width: 4.5rem;
        background: #21867a;
        margin: 0.5rem auto 1.5rem auto;
        border-radius: 4px;
      "></span>
    </h1>
    <p style="
      font-size: 1.15rem;
      max-width: 620px;
      margin: 0 auto 2rem;
      line-height: 1.6;
      color: #57606a;
    ">
      This blog platform makes writing and managing content effortless. Create posts, sort with categories & tags, and enjoy a secure, mobile-friendly experience—all designed for simplicity and speed.

Happy blogging! 
    </p>
&nbsp;
&nbsp;

    <div style="display: flex; justify-content: space-around; flex-wrap: wrap; gap: 2rem; margin-bottom: 3rem;">
      <div style="flex: 1 1 160px; max-width: 160px;">
        <svg xmlns="http://www.w3.org/2000/svg" fill="#21867a" viewBox="0 0 24 24" width="48" height="48" aria-hidden="true" focusable="false" style="margin-bottom: 0.7rem;">
          <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 
            10-4.477 10-10S17.523 2 12 2zm0 18a8 8 0 1 1 0-16 
            8 8 0 0 1 0 16z"/>
          <path d="M11 6h2v6h-2zM11 14h2v2h-2z"/>
        </svg>
        <h3 style="font-size: 1.15rem; margin-bottom: 0.3rem; color: #34495e;"> Effortless Content Management</h3>
        <p style="font-size: 0.95rem; color: #64707d;">Write, edit & organize posts seamlessly. Upload images, customize layouts, and bring ideas to life—all in one intuitive platform.</p>
      </div>
      <div style="flex: 1 1 160px; max-width: 160px;">
        <svg xmlns="http://www.w3.org/2000/svg" fill="#21867a" viewBox="0 0 24 24" width="48" height="48" aria-hidden="true" focusable="false" style="margin-bottom: 0.7rem;">
          <path d="M5 13c0-4 7-8 7-8s7 4 7 8-3 7-7 7-7-3-7-7z"/>
          <circle cx="12" cy="13" r="3"/>
        </svg>
        <h3 style="font-size: 1.15rem; margin-bottom: 0.3rem; color: #34495e;">Smart Organization & Security</h3>
        <p style="font-size: 0.95rem; color: #64707d;">Easily categorize posts with tags & stay secure with protected login. Keep your content tidy and your account safe.</p>
      </div>
      <div style="flex: 1 1 160px; max-width: 160px;">
        <svg xmlns="http://www.w3.org/2000/svg" fill="#21867a" viewBox="0 0 24 24" width="48" height="48" aria-hidden="true" focusable="false" style="margin-bottom: 0.7rem;">
          <path d="M12 4a8 8 0 0 0-8 8c0 3.314 2.686 6 6 6v2h4v-2c3.314 0 6-2.686 6-6a8 8 0 0 0-8-8z"/>
          <circle cx="12" cy="12" r="3"/>
        </svg>
        <h3 style="font-size: 1.15rem; margin-bottom: 0.3rem; color: #34495e;">Seamless User Experience</h3>
        <p style="font-size: 0.95rem; color: #64707d;">Enjoy buttery-smooth navigation with intuitive controls that adapt to your needs. Every click feels natural, every action flows effortlessly.</p>
      </div>
    </div>
&nbsp;
&nbsp;

    <button onclick="scrollToGetInTouch()" style="
      background-color: #21867a;
      color: white;
      padding: 0.85rem 3.5rem;
      font-size: 1.1rem;
      font-weight: 700;
      border: none;
      border-radius: 30px;
      cursor: pointer;
      box-shadow: 0 7px 22px #21867a(41, 128, 185, 0.45);
      transition: background-color 0.3s ease;
    " onmouseover="this.style.backgroundColor='#e76f51'" onmouseout="this.style.backgroundColor='#21867a'">
      Get in Touch
    </button>
  </section>
</main>
&nbsp;
&nbsp;

<script>
  function scrollToGetInTouch() {
    const section = document.querySelector('#get-in-touch');
    if(section) {
      section.scrollIntoView({ behavior: 'smooth' });
    } else {
      alert('Get in Touch section not found.');
    }
  }
</script>