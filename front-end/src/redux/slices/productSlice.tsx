import { createSlice } from "@reduxjs/toolkit";
import { useDispatch } from "react-redux";

const productSlice = createSlice({
    name: 'Describe New Product',
    initialState: {
        id: undefined,
        name: undefined,
        description: undefined,
        image: undefined
    },
    reducers: {
        setId: (state, action)=>{
            state.id = action.payload.id
        },
        setName: (state, action)=>{
            state.name = action.payload.name
        },
        setDescription: (state, action)=>{
            state.description = action.payload.description
        },
        setImage: (state, action)=>{
            state.image = action.payload.image
        },
        getProductInfo: (state, action)=>{
            return {
                id: state.id,
                name: state.name,
                description: state.description,
                image: state.image
            }
        }
    }
});

export const {setId, setName, setDescription, setImage} = productSlice.actions;
export default productSlice;