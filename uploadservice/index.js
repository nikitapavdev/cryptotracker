const express = require('express');
const app = express();
const port = 8080;

app.get('/prices', (req, res) => {
  res.json({ message: 'Express.js Node Service Placeholder' });
});

app.listen(port, () => {
  console.log(`Node service running on port ${port}`);
});
