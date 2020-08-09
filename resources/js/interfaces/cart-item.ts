import BuyableInterface from './buyable';

export default interface CartItemInterface {
    id: number;
    user_id: number;
    qty: number;
    size: number;
    color: number;
    price: number;
    instance: string;
    options: string[];
    buyable_type: string;
    buyable_id: number;
    buyable: BuyableInterface;
}