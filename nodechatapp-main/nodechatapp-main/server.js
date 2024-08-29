const WebSocket = require('ws');
const url = require('url');

const wss = new WebSocket.Server({ port: 8080 });

wss.on('connection', function connection(ws, req) {
  const queryParams = url.parse(req.url, true).query;
  const username = queryParams.username;

  ws.on('message', function incoming(message) {
    wss.clients.forEach(function each(client) {
      if (client !== ws && client.readyState === WebSocket.OPEN) {
        const data = message.toString(); // Convert Buffer to string
        client.send(JSON.stringify({ username, message: data })); // Send string instead of Buffer
        
      }
    });
  });
});
