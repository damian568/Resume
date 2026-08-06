// Vercel serverless function for the portfolio contact form.
// Replaces the old raw-SMTP PHP mailer — same validation rules and
// email shape, sent via nodemailer instead. Requires these env vars
// to be set in the Vercel project (Settings -> Environment Variables):
//   SMTP_HOST, SMTP_PORT, SMTP_USER, SMTP_PASS, CONTACT_RECIPIENT
const nodemailer = require('nodemailer');

const trim = (value) => (typeof value === 'string' ? value.trim() : '');
const hasNewline = (value) => /[\r\n]/.test(value);

module.exports = async (req, res) => {
  if (req.method !== 'POST') {
    res.status(405).json({ success: false, message: 'Method not allowed.' });
    return;
  }

  const body = req.body || {};
  const name = trim(body.name);
  const email = trim(body.email);
  const userSubject = trim(body.subject);
  const message = trim(body.message);

  if (!name || !email || !message) {
    res.status(422).json({ success: false, message: 'Please fill in all fields.' });
    return;
  }

  if (hasNewline(name) || hasNewline(email) || hasNewline(userSubject)) {
    res.status(422).json({ success: false, message: 'Invalid input.' });
    return;
  }

  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    res.status(422).json({ success: false, message: 'Please enter a valid email address.' });
    return;
  }

  if (message.length > 5000) {
    res.status(422).json({ success: false, message: 'Message is too long.' });
    return;
  }

  if (userSubject.length > 150) {
    res.status(422).json({ success: false, message: 'Subject is too long.' });
    return;
  }

  const { SMTP_HOST, SMTP_PORT, SMTP_USER, SMTP_PASS, CONTACT_RECIPIENT } = process.env;

  if (!SMTP_HOST || !SMTP_PORT || !SMTP_USER || !SMTP_PASS || !CONTACT_RECIPIENT) {
    res.status(500).json({ success: false, message: 'Mail is not configured yet on this server.' });
    return;
  }

  const emailSubject = userSubject
    ? `Portfolio contact form: ${userSubject}`
    : `Portfolio contact form - message from ${name}`;

  const textBody = 'You received a new message from your portfolio site.\n\n'
    + `Name: ${name}\n`
    + `Email: ${email}\n`
    + (userSubject ? `Subject: ${userSubject}\n` : '')
    + `\nMessage:\n${message}\n`;

  const transporter = nodemailer.createTransport({
    host: SMTP_HOST,
    port: Number(SMTP_PORT),
    secure: Number(SMTP_PORT) === 465,
    auth: { user: SMTP_USER, pass: SMTP_PASS },
  });

  try {
    await transporter.sendMail({
      from: `"Portfolio Contact Form" <${SMTP_USER}>`,
      to: CONTACT_RECIPIENT,
      replyTo: email,
      subject: emailSubject,
      text: textBody,
    });
    res.status(200).json({ success: true, message: `Thanks, ${name}! Your message has been sent.` });
  } catch (err) {
    console.error('Contact form SMTP error:', err);
    res.status(500).json({
      success: false,
      message: 'Sorry, something went wrong sending your message. Please try again later or email me directly.',
    });
  }
};
