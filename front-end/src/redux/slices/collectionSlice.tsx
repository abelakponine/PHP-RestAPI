import { createSlice } from "@reduxjs/toolkit";

const collectionSlice = createSlice({
    name: "Product Collections",
    initialState: {
        collections: new Array<any>()
    },
    reducers: {
        
        updateCollections: (state, action)=>{
            // console.log(action.payload);
            state.collections = action.payload;
        }
    }
});

export const {updateCollections} = collectionSlice.actions;
export default collectionSlice;
