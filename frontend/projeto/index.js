//const electron = require('electron')

//const {app} = electron;

//app.on('ready', ( ) => {
   //const janelaPrincipal = new electron.BrowserWindow({});
   //janelaPrincipal.loadURL(`file://${__dirname}/index.html`)
//})

const {app, BrowserWindow, nativeTheme} = require('electron')

const createWindow = () => {
   nativeTheme.themeSource = 'dark'
   const win = new BrowserWindow({
      width: 800,
      height:600,
      icon: './img/Scar.png'
   })

   win.loadFile('./login/login.html')
}
   app.whenReady().then(() => {
      createWindow()
   })