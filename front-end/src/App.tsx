import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Index from './views/index';

const App:()=>JSX.Element = ()=>{
    return (
        <Router>
            <Routes>
                <Route path='/' element={<Index/>}/>
            </Routes>
        </Router>
    );
}
export default App;
