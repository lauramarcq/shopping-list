import { shallowMount } from "@vue/test-utils";
import ShoppingList from "./shoppingList";

describe("ShoppingList", () => {
    it("renders the name and formatted date correctly", () => {
        const name = "My Shopping List";
        const createdAt = "2022-01-01T12:00:00Z";

        const wrapper = shallowMount(ShoppingList, {
            props: {
                name,
                createdAt,
            },
        });

        expect(wrapper.find(".text-gray-900").text()).toBe(name);
        expect(wrapper.find(".text-gray-500").text()).toBe(
            "1/1/2022, 12:00:00 PM"
        );
    });

    it('emits "editList" event when edit button is clicked', () => {
        const name = "My Shopping List";
        const createdAt = "2022-01-01T12:00:00Z";

        const wrapper = shallowMount(ShoppingList, {
            props: {
                name,
                createdAt,
            },
        });

        wrapper.find("button").trigger("click");

        expect(wrapper.emitted("editList")).toBeTruthy();
    });
});
