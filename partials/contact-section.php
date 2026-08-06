        <!-- Contact -->
        <section id="contact" class="section">
          <div class="container">
            <div class="section-header reveal">
              <p class="eyebrow">07 · Contact</p>
              <h2>Let's talk</h2>
              <p>Have a project, an opportunity, or just want to say hi? Reach out below.</p>
            </div>

            <div class="contact-grid">
              <div class="contact-cards reveal">
                <a class="card contact-card" href="mailto:didi.milenov@gmail.com">
                  <span class="icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                  </span>
                  <span>
                    <span class="label">Email</span>
                    <span class="value">didi.milenov@gmail.com</span>
                  </span>
                </a>
                <a class="card contact-card" href="tel:+359877797290">
                  <span class="icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                  </span>
                  <span>
                    <span class="label">Phone</span>
                    <span class="value">+359 877 797 290</span>
                  </span>
                </a>
                <a class="card contact-card" href="https://github.com/damian568" target="_blank" rel="noopener noreferrer">
                  <span class="icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12,2.2467A10.00042,10.00042,0,0,0,8.83752,21.73419c.5.08752.6875-.21247.6875-.475,0-.23749-.01251-1.025-.01251-1.86249C7,19.85919,6.35,18.78423,6.15,18.22173A3.636,3.636,0,0,0,5.125,16.8092c-.35-.1875-.85-.65-.01251-.66248A2.00117,2.00117,0,0,1,6.65,17.17169a2.13742,2.13742,0,0,0,2.91248.825A2.10376,2.10376,0,0,1,10.2,16.65923c-2.225-.25-4.55-1.11254-4.55-4.9375a3.89187,3.89187,0,0,1,1.025-2.6875,3.59373,3.59373,0,0,1,.1-2.65s.83747-.26251,2.75,1.025a9.42747,9.42747,0,0,1,5,0c1.91248-1.3,2.75-1.025,2.75-1.025a3.59323,3.59323,0,0,1,.1,2.65,3.869,3.869,0,0,1,1.025,2.6875c0,3.83747-2.33752,4.6875-4.5625,4.9375a2.36814,2.36814,0,0,1,.675,1.85c0,1.33752-.01251,2.41248-.01251,2.75,0,.26251.1875.575.6875.475A10.0053,10.0053,0,0,0,12,2.2467Z" fill="currentColor"/></svg>
                  </span>
                  <span>
                    <span class="label">GitHub</span>
                    <span class="value">github.com/damian568</span>
                  </span>
                </a>
                <div class="card contact-card">
                  <span class="icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                  </span>
                  <span>
                    <span class="label">Location</span>
                    <span class="value">Vratsa, Bulgaria</span>
                    <span class="value">Sofia, Student City, Bulgaria</span>
                  </span>
                </div>
              </div>

              <form id="contact-form-el" class="card contact-form reveal">
                <div class="form-row">
                  <div class="form-group">
                    <label for="cf-name">Name</label>
                    <input type="text" id="cf-name" name="name" placeholder="Your name" required maxlength="120" />
                  </div>
                  <div class="form-group">
                    <label for="cf-email">Email</label>
                    <input type="email" id="cf-email" name="email" placeholder="you@example.com" required maxlength="180" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="cf-message">Message</label>
                  <textarea id="cf-message" name="message" rows="5" placeholder="What's on your mind?" required maxlength="5000"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
                <p id="form-status" class="form-status"></p>
              </form>
            </div>
          </div>
        </section>
