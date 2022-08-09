import './css/index.css';
import { useParams } from "react-router-dom";
import { useDispatch, useSelector } from 'react-redux';
import { updateCollections } from '../redux/slices/collectionSlice';
import { useEffect } from 'react';

const Index: (params:any)=>JSX.Element = (params)=>{
    var collections = useSelector(state=>state) as {collectionSlice:{collections:[]}};
    const dispatch = useDispatch();

    useEffect(()=>{
        
        (()=>{
            setTimeout(async ()=>{
                
                let collection = await fetch('http://localhost/products').then(res=>{
                    return res.json();
                });
                
                dispatch(updateCollections(collection));

                const addPC_btn = (document.getElementById('addPC') as HTMLButtonElement);

                addPC_btn.disabled = false;
                addPC_btn.onclick = (event)=>{
                    event.preventDefault();
                    event.stopPropagation();
                    
                    (document.querySelector("#addPC i") as HTMLElement).style.display = 'inline';

                    fetch('http://localhost/addProduct', {
                        method: 'POST',
                        body: JSON.stringify({
                            id: (document.getElementById('pid') as HTMLInputElement).value,
                            name: (document.getElementById('pname') as HTMLInputElement).value,
                            description: (document.getElementById('description') as HTMLTextAreaElement).value,
                            price: (document.getElementById('price') as HTMLInputElement).value
                        })
                    }).then(async res=>{    
                        res.text().then(res=>{
                            console.log(res.toString());
                            dispatch(updateCollections(new Array(res)));
                            
                            // reset input fields
                            (document.getElementById('pname') as HTMLInputElement).value = '';
                            (document.getElementById('description') as HTMLTextAreaElement).value = '';
                            (document.getElementById('price') as HTMLInputElement).value = '';

                            (document.querySelector("#addPC i") as HTMLElement).style.display = 'none';
        
                        })
                    });

                }
            }, 3000);
        })()
    });

    return (
        <div>
            <h1 style={{fontSize:'1.8rem'}}>{"{PHP} RestAPI"} - Products Collection</h1>
            <h2 style={{fontSize:'22px'}} className='my-4'>Technologies: PHP / React / Redux</h2>
            <h3 style={{fontSize:'18px'}} className='my-2'>Create New Product</h3>

            <div className='d-flex' style={{width:'100%'}}>
                {/* Add New Products */}
                <div style={{width:'100%'}}>
                    <form method='post' action='http://localhost/addProduct'>
                        <table>
                            <tbody>
                                <tr><td>
                                    <input className="form-control" type="text" name="product_name" placeholder="Enter Product ID" value={collections.collectionSlice.collections.length+1} id='pid' readOnly required/>
                                </td></tr>
                                <tr><td>
                                    <input className="form-control" type="text" name="product_name" placeholder="Enter Product Name" id='pname' required/>
                                </td></tr>
                                <tr><td>
                                    <textarea id='description' className="form-control" placeholder="Enter Product Description" required/>
                                </td></tr>
                                <tr><td>
                                    <span className='form-label'>Price:</span>
                                    <input className="form-control" type="number" name="product_price" placeholder="100" id='price' required/>
                                </td></tr>
                                <tr><td>
                                    <button id='addPC' className="btn btn-primary my-2" onClick={(event)=>{
                                        event.preventDefault();
                                        event.stopPropagation();
                                        
                                    }} disabled>Add Product to Collection <i className='fa fa-spinner fa-spin' style={{display:"none"}}></i></button>
                                </td></tr>
                                <tr><td>
                                    <button className="btn btn-danger my-1" onClick={(event)=>{
                                        event.preventDefault();
                                        event.stopPropagation();

                                        let confirmed: boolean = window.confirm("Are you sure to reset collection?");

                                        if (confirmed){
                                            fetch('http://localhost/reset').then(async res=>{    
                                                res.text().then(res=>{
                                                    alert(res.toString());
                                                })
                                            });
                                        }

                                    }}>Reset Collection</button>
                                </td></tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                {/** Display Collections */}
                <div style={{width:'100%'}}>
                    <h3 style={{fontSize:'1.6rem'}}>List of Items in Collections</h3>
                    <pre>
                        {(()=>{
                            let view:JSX.Element[] = [];
                            let key = 1;
                            
                            if (collections.collectionSlice.collections.length > 0){
                                collections.collectionSlice.collections.forEach(i=>{
                                    // console.log(i);
                                    view.push(<p key={key}><b>Item {key}:</b> &nbsp;{JSON.stringify(i)}</p>);
                                    key++;
                                })
                                return view;
                            }
                            else if (collections.collectionSlice.collections.length === 0){
                                return "No Item found in collection\r\nPlease create new item.";
                            }
                            else {
                                return <h4 style={{fontSize:'1.2rem'}}><i className='fa fa-spinner fa-spin'></i> Fetching Collections...</h4>
                            }
                        })()}
                    </pre>
                </div>
            </div>
        </div>
    );
}

const Func = (props:any)=>{
    return <Index {...props} params={useParams()}/>
}
export default Func;