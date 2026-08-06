#!/usr/bin/env node
// Assembles index.html from index.template.html + partials/*.html.
// Run `node build.js` after editing any partial, then commit the
// regenerated index.html — Vercel serves it as a plain static file,
// no server-side include mechanism needed.
'use strict';
const fs = require('fs');
const path = require('path');

const ROOT = __dirname;
const template = fs.readFileSync(path.join(ROOT, 'index.template.html'), 'utf8');

const output = template.replace(/<!--#include\s+([\w-]+)\s*-->/g, (match, name) => {
  const partialPath = path.join(ROOT, 'partials', `${name}.html`);
  if (!fs.existsSync(partialPath)) {
    throw new Error(`Missing partial: ${partialPath}`);
  }
  return fs.readFileSync(partialPath, 'utf8').replace(/\n$/, '');
});

fs.writeFileSync(path.join(ROOT, 'index.html'), output);
console.log('Built index.html');
