import React from 'react';
import logo from './logo.svg';
import './App.css';
import TheForm from './components/form/index.jsx';

function App() {
  console.log('react app has loaded');
  return (
    <div className="App" id="inject-react-frame">
      {/* <header className="App-header">
        <img src={logo} className="App-logo" alt="logo" />
        <p>
          Edit <code>src/App.js</code> and save to reload.
        </p>
        <a
          className="App-link"
          href="https://reactjs.org"
          target="_blank"
          rel="noopener noreferrer"
        >
          Learn React
        </a>
      </header> */}

      <h3>Inject React Form</h3>
      <TheForm/>
    </div>
  );
}

export default App;
