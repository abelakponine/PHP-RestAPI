import { combineReducers } from "redux";
import { configureStore } from "@reduxjs/toolkit";
import productSlice from "./slices/productSlice";
import collectionSlice from "./slices/collectionSlice";

const reducers = combineReducers({
    productSlice: productSlice.reducer,
    collectionSlice: collectionSlice.reducer
});

const store = configureStore({
    reducer: reducers
});

export default store;